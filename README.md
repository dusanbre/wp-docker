# Wordpress Docker

## Setup

1. Clone repo
2. Cd in repo
3. Run `./init.sh` - this will create .env file and set correct permission for volume files
4. Modify .env file if you want to set wordpress and database user, password, etc...
5. After init is done, just run `docker compose up` or `docker compose up -d` if you want containers to run in background.
6. You can start to develop.

### Note

When docker pull all images and finish setup, you will get more files in `wp-conetnt`. To add you theme and plugins, you can install it through dashboard, or copy files and folders in themes or plugins dir.
