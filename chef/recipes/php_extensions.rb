package "php5-curl" do
  action :install
end

package "php5-mcrypt" do
  action :install
end

# Force mcrypt PHP extension to be enabled in Ubuntu (our environment)
execute "/usr/sbin/php5enmod mcrypt" do
   only_if { platform?('ubuntu') && node['platform_version'].to_f >= 12.04 && ::File.exists?('/usr/sbin/php5enmod') }
end

package "php5-redis" do
  action :install
end

package "php5-mysql" do
  action :install
end

package "php5-gd" do
  action :install
end
