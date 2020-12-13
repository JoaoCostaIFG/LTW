#!/bin/sh

printf "User: "
read -r user

ssh "${user}"@gnomo.fe.up.pt rm -rf public_html/*
scp -r actions api css database includes js pages static templates favicon.ico index.php up201806560@gnomo.fe.up.pt:public_html/
