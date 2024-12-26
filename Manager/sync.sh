#!/bin/bash
supported_users=("USERNAME_HERE")
do_restart_engines=false
do_stop_engines=false
sync_dev=true
cleanup=false
sync_global=false
replace_dev_production=false
phpBinary=/usr/bin/php

# Colors
red=`tput setaf 1`
green=`tput setaf 2`
reset=`tput sgr0`

if [ "$1" == "config" ]
then
    nano /home/travian/$2/servers/$3/include/config.custom.php
    exit
elif [ "$1" == "log" ]
then
    nano /home/travian/$2/servers/$3/include/error_log.log
    exit
elif [ "$1" == "clearLog" ]
then
    cat /dev/null > /home/travian/$2/servers/$3/include/error_log.log
    echo "Done"
    exit
elif [ "$1" == "tailLog" ]
then
    tail -f /home/travian/$2/servers/$3/include/error_log.log
    exit
fi

function stop(){
    for user in ${supported_users[@]}
        do
            baseDir="/home/travian/$user/servers"
            dir=( $(find "$baseDir" -maxdepth 1 -type d -printf '%P\n') )
            for worldId in ${dir[@]}
            do
                    worldPath=$baseDir/$worldId
                    if [ ! -f "$worldPath/include/env.php" ]
                    then
                        continue
                    fi
                    serviceName=${user}_${worldId}
                    systemctl stop "$serviceName" >/dev/null
            done
    done
}
function install(){
    systemctl disable --quiet TravianIndex.service && systemctl stop --quiet TravianIndex.service
    systemctl disable --quiet TravianMail.service && systemctl stop --quiet TravianMail.service
    systemctl disable --quiet TravianTaskWorker.service && systemctl stop --quiet TravianTaskWorker.service

    rm -rf /etc/systemd/system/TravianIndex.service
    rm -rf /etc/systemd/system/TravianMail.service
    rm -rf /etc/systemd/system/TravianTaskWorker.service

    ln /travian/services/main/TravianIndex.service /etc/systemd/system/TravianIndex.service
    ln /travian/services/main/TravianMail.service /etc/systemd/system/TravianMail.service
    ln /travian/services/main/TravianTaskWorker.service /etc/systemd/system/TravianTaskWorker.service

    # Ensure the necessary scripts are executable
    chmod +x /travian/angularIndex/server.js
    chmod +x /travian/mailNotify/include/mailNotify.sh
    chmod +x /travian/TaskWorker/runTasks.php

    systemctl daemon-reload

    systemctl enable --quiet TravianIndex.service && systemctl start --quiet TravianIndex.service
    systemctl enable --quiet TravianMail.service && systemctl start --quiet TravianMail.service
    systemctl enable --quiet TravianTaskWorker.service && systemctl start --quiet TravianTaskWorker.service

    rm -rf /usr/bin/travian /usr/local/bin/travian
    ln -s /travian/Manager/sync.sh /usr/bin/travian
    ln -s /travian/Manager/sync.sh /usr/local/bin/travian
    echo "0 0 * * * /usr/bin/travian --cron" > /etc/cron.d/travian-cron
}
function check_service(){
    status=$(systemctl is-active $1)
    if [ $status == "active" ]
    then
        echo -e "\t$1: ${green}Active${reset}"
    else
        echo -e "\t$1: ${red}Inactive${reset}"
    fi
}
function status(){
    echo "Main services:"
    check_service "TravianTaskWorker.service"
    check_service "TravianMail.service"
    check_service "TravianIndex.service"
    for user in ${supported_users[@]}
    do
        echo "$user services:"
        services=$(ls /travian/services/${user} | grep $user\\_*)
        for service in $services
        do
            check_service $service
            systemctl enable --quiet $service
        done
    done
    exit
}
function start(){
     for user in ${supported_users[@]}
        do
            baseDir="/home/travian/$user/servers"
            dir=( $(find "$baseDir" -maxdepth 1 -type d -printf '%P\n') )
            for worldId in ${dir[@]}
            do
                worldPath=$baseDir/$worldId
                if [ ! -f "$worldPath/include/env.php" ]
                then
                    continue
                fi
                serviceName=${user}_${worldId}
                systemctl start "$serviceName" >/dev/null
            done
    done
}
function update_dev(){
    for user in ${supported_users[@]}
    do
        baseDir="/home/travian/$user/servers"
        dir=( $(find "$baseDir" -maxdepth 1 -type d -printf '%P\n') )
        for worldId in ${dir[@]}
            do
                worldPath=$baseDir/$worldId
                if [ "$worldId" != "dev" ]
                then
                    continue
                fi
                if [ ! -f "$worldPath/include/env.php" ]
                then
                    continue
                fi
                serviceName=${user}_${worldId}
                # systemctl stop "$serviceName" >/dev/null
                sudo -u travian $phpBinary "$worldPath/include/update.php" --patch
                # systemctl start "$serviceName" >/dev/null
            done
    done
}
function update(){
    for user in ${supported_users[@]}
    do
        baseDir="/home/travian/$user/servers"
        dir=( $(find "$baseDir" -maxdepth 1 -type d -printf '%P\n') )
        for worldId in ${dir[@]}
            do
                worldPath=$baseDir/$worldId
                if [ ! -f "$worldPath/include/env.php" ]
                then
                    continue
                fi
                serviceName=${user}_${worldId}
                # systemctl stop "$serviceName" >/dev/null
                sudo -u travian $phpBinary "$worldPath/include/update.php" --patch
                # systemctl start "$serviceName" >/dev/null
            done
    done
}
function restart(){
    for user in ${supported_users[@]}
    do
        baseDir="/home/travian/$user/servers"
        dir=( $(find "$baseDir" -maxdepth 1 -type d -printf '%P\n') )
        for worldId in ${dir[@]}
        do
            worldPath=$baseDir/$worldId
            if [ ! -f "$worldPath/include/env.php" ]
            then
                continue
            fi
            serviceName=${user}_${worldId}
            systemctl restart "$serviceName" >/dev/null
        done
    done
}
function syncPrivate(){
    for user in ${supported_users[@]}
        do
            baseDir="/home/travian/$user/servers"
            dir=( $(find "$baseDir" -maxdepth 1 -type d -printf '%P\n') )
            for worldId in ${dir[@]}
            do
                    worldPath=$baseDir/$worldId
                    if [ ! -f "$worldPath/include/env.php" ]
                    then
                        continue
                    fi
                    if [ "$worldId" != "dev" ]
                    then
                        rsync -a --chown=travian:travian "/travian/main_script/copyable/public/" "$worldPath/public/"
                    else
                        rsync -a --chown=travian:travian "/travian/main_script_dev/copyable/public/" "$worldPath/public/"
                    fi
                    chmod o+x $worldPath/public
                    chmod +x $worldPath/include/${user}_${worldId}.service.php
            done
        done
}
for i in "$@"
do
case $i in
    --replace-dev)
        rsync -v -a --delete "/travian/main_script_dev/" "/travian/main_script/"
        syncPrivate
        shift
    ;;
    --update)
        update
        shift
    ;;
    --update_dev)
        update_dev
        shift
    ;;
    --stop)
        stop
        shift
    ;;
    --start)
        start
        shift
    ;;
    --status)
        status
        shift
    ;;
    --restart)
        restart
        shift
    ;;
    --install)
        install
        shift
    ;;
    --sync-gpack)
        rsync --chmod=Du=rwx,Dgo=rx,Fu=rw,Fog=r --chown=travian:travian -a --delete "/travian/sections/gpack/" "/home/travian/gpack/"
        shift
    ;;
    --sync-private)
        syncPrivate
        shift
    ;;
    --update-ssl)
        certbot certonly --manual -d *.$2 -d $2 --preferred-challenges dns-01 --server https://acme-v02.api.letsencrypt.org/directory
        shift
    ;;
    --show-stat)
        for user in ${supported_users[@]}
        do
            dir=( $(find "/home/travian/$user/servers" -maxdepth 1 -type d -printf '%P\n') )
            for worldId in ${dir[@]}
            do
                mysql -u root "${user:0:8}_$worldId" -s -r -e 'SELECT COUNT(id) as reports_count FROM ndata';
            done
        done
        shift
    ;;
    --sync-global)
        baseDir="/home/travian/"
        mkdir -p /home/travian/gpack/
        rsync --chown=travian:travian -a --delete "/travian/sections/gpack/" "$baseDir/gpack/"

        for user in ${supported_users[@]}
        do
            mkdir -p $baseDir/$user/payment/
            rsync --chmod=Du=rwx,Dgo=rx,Fu=rw,Fog=r --chown=travian:travian -a --delete "/travian/sections/payment/" "$baseDir/$user/payment/"

            mkdir -p $baseDir/$user/voting/
            rsync --chmod=Du=rwx,Dgo=rx,Fu=rw,Fog=r --chown=travian:travian -a --delete "/travian/sections/voting/" "$baseDir/$user/voting/" --exclude="include/voting.log"

            mkdir -p $baseDir/$user/api/
            rsync --chmod=Du=rwx,Dgo=rx,Fu=rw,Fog=r --chown=travian:travian -a --delete "/travian/sections/api/" "$baseDir/$user/api/"

            baseDir="/home/travian/$user/servers"
            dir=( $(find "$baseDir" -maxdepth 1 -type d -printf '%P\n') )
            for worldId in ${dir[@]}
            do
                    worldPath=$baseDir/$worldId
                    if [ ! -f "$worldPath/include/env.php" ]
                    then
                        continue
                    fi
                    chmod o+x $worldPath/public
                    chmod +x $worldPath/include/${user}_${worldId}.service.php
            done
        done
        shift
    ;;
    --cron)
        find /travian -name "*.zip"  -delete
        find /travian -name "*.zip" -delete
        find /travian -name "*.rar" -delete
        find /travian -name "*.gzip" -delete
        find /travian -name "*.gz" -delete
        find /travian -name "*.tar" -delete
        find /travian -name "*.tar.gz" -delete
        find /travian -name "*.tar.gzz" -delete


        find /home -name "*.zip" -not -path "/home/virtfs/*" -delete
        find /home -name "*.rar" -not -path "/home/virtfs/*" -delete
        find /home -name "*.gzip" -not -path "/home/virtfs/*" -delete
        find /home -name "*.gz" -not -path "/home/virtfs/*" -delete
        find /home -name "*.tar" -not -path "/home/virtfs/*" -delete
        find /home -name "*.tar.gz" -not -path "/home/virtfs/*" -delete
        find /home -name "*.tar.gzz" -not -path "/home/virtfs/*" -delete
        shift # past argument with no value
    ;;
    *)
          # unknown option
    ;;
esac
done
printf "Complete!\n"
