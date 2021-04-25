#!/bin/bash

if [ ! -e /var/www/l_wtt/config/jwt/public.pem ]; then

    mkdir -p /var/www/l_wtt/config/jwt ; 
    cd /var/www/l_wtt/config/jwt ;
    jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' /var/www/l_wtt/.env.local | cut -f 2 -d ''='')};
    if [ ! -f public.pem ] ; then echo ${jwt_passphrase} | openssl genpkey -out private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096; fi
    if [ ! -f public.pem ] ; then echo ${jwt_passphrase} | openssl pkey -in private.pem -passin stdin -out public.pem -pubout; fi;
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX /var/www/l_wtt/config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX /var/www/l_wtt/config/jwt
    if [ $APPLY_ACL_TO_ROOT eq 1 ] ; then
        setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX /var/www/l_wtt/config/jwt
        setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX /var/www/l_wtt/config/jwt
    fi
fi
