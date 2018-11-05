<?php
namespace ProjectSilly\BackendBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use ProjectSilly\CoreBundle\Entity\AuditLog;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ProjectSilly\UserBundle\Entity\User;

/**
 * Class DoctrineListener
 * @package ProjectSilly\BackendBundle\Listener
 */
class DoctrineListener {
	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * @var bool
	 */
	private $needsFlush;

	/**
	 * @var array
	 */
	private $logClasses = array(
		'AuditLog',
	);

	/**
	 * DoctrineListener constructor.
	 *
	 * @param ContainerInterface|null $container
	 */
	public function __construct( ContainerInterface $container = null ) {
		$this->container = $container;
	}

	/**
	 * @param $args
	 * @param string $changes
	 */
	private function auditLog( $args, $changes = '' ) {

		if ( ! $args instanceof preUpdateEventArgs && ! $args instanceof LifecycleEventArgs ) {
			return;
		}

		$entity = $args->getEntity();
		$c      = explode( '\\', get_class( $entity ) );
		$v      = array_shift( $c );
		$c      = array_pop( $c );

		if ( $v != 'ProjectSilly' || in_array( $c, $this->logClasses ) ) {
			return;
		}

		if ( ! $this->container->get( 'security.token_storage' )->getToken() ) {
			return;
		}

		$changesArray = array( $changes );

		if ( $changes == 'update' ) {
			$changes = $args->getEntityChangeSet();

			if ( is_array( $changes ) ) {
				foreach ( $changes as $field => $change ) {
					if ( ! isset( $change[1] ) ) {
						continue;
					}
					$x              = $change[1] instanceof \DateTime ? $change[1]->format( 'Y-m-d H:i' ) : $change[1];
					$changesArray[] = "{$field}:{$x}";
				}
			}
		}

		$entity = $args->getEntity();
		$userIp = $this->container->get( 'request' )->getClientIp();
		$user   = $this->container->get( 'security.token_storage' )->getToken()->getUser();

		if ( $user instanceof User && is_object( $entity ) ) {
			$auditLog = new AuditLog();
			$auditLog->setUser( $user );
			$auditLog->setEntity( $c );
			$auditLog->setEntityId( $entity->getId() );
			$auditLog->setValues( implode( ' ', $changesArray ) );
			$auditLog->setUserIp( $userIp );
			$args->getEntityManager()->persist( $auditLog );
			$this->needsFlush = true;
		}
	}

	/**
	 * @param PreUpdateEventArgs $args
	 */
	public function preUpdate( preUpdateEventArgs $args ) {
		self::auditLog( $args, 'update' );

	}

	/**
	 * @param LifecycleEventArgs $args
	 */
	public function postUpdate( LifecycleEventArgs $args ) {
	}

	/**
	 * @param LifecycleEventArgs $args
	 */
	public function postPersist( LifecycleEventArgs $args ) {
		self::auditLog( $args, 'insert' );
	}

	/**
	 * @param LifecycleEventArgs $args
	 */
	public function preRemove( LifecycleEventArgs $args ) {
		self::auditLog( $args, 'remove' );

	}

	/**
	 * @param PostFlushEventArgs $eventArgs
	 */
	public function postFlush( PostFlushEventArgs $eventArgs ) {
		if ( $this->needsFlush ) {
			$this->needsFlush = false;
			$eventArgs->getEntityManager()->flush();
		}
	}

}