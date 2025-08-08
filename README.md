# WoW Private Server Website
Website for WoW private server. Features signup, changing password and viewing characters.

## Building a new image
To build the image for both `amd64` and `arm64` CPUs, use the below command.

```bash
# Authenticate (use a personal access token with write:packages permissions)
docker login ghcr.io -u kevin

docker buildx build --platform linux/arm64,linux/amd64 -t ghcr.io/kevinfrom/wow-private-server-website:[version] -t ghcr.io/kevinfrom/wow-private-server-website:latest --push .
```

## Configuration

Configuration is done through the `.env` file. A `.env.example` file is provided, which you can copy and adjust as needed.

If you're using the provided `docker-compose.yml` file, your `DB_HOST` will be `mariadb`.

