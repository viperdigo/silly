role :app, "silly.com", :primary => true
role :web, "silly.com"

set :deploy_to, "/var/www/html/#{application}/live"
set :user, "root"
set :keep_releases,   3