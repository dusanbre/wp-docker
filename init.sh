#!/bin/bash

[ -f ".env" ] && {
  echo "This project has been initialized already. Exiting..."
  exit 1;
}

# Prepare env
cp .env.example .env

# This is required so that Docker keeps correct permissions
# when source directories get mounted as volumes
mkdir -p wp-content/themes
mkdir -p wp-content/plugins

# This will use your user's UID/GID for containers so that
# files generated in them have correct permissions
fsuser="$(id -u):$(id -g)"
sed -i "s/WP_FS_USER=1000:1000/WP_FS_USER=${fsuser}/g" .env

echo "Done. Now you can run docker compose up!"