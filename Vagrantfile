Vagrant::Config.run do |config|
    
    # Add to /etc/hosts: 192.168.10.30 dev.twitterparty.mozilla.com
    config.vm.network("192.168.10.30")

    config.vm.box = "lucid32"

    config.vm.provision :chef_solo do |chef|
        chef.recipe_url = "http://cloud.github.com/downloads/lmorchard/my-vagrant-cookbooks/cookbooks.tgz"
        chef.cookbooks_path = [
            'vagrant-assets/cookbooks',
            [:vm, "cookbooks"]
        ]
        chef.run_list = [
            "recipe[mozilla_twitter_collage]"
        ]
    end

end
