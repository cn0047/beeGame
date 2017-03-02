Vagrant.configure(2) do |config|
  config.vm.box = "bento/ubuntu-16.04"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network :forwarded_port, guest: 22, host: 10170, id: "ssh"
  config.vm.provision :shell, path: "VagrantProvision.sh"
  config.vm.synced_folder ".", "/var/www/html", rsync__exclude: ".vagrant/"
end
