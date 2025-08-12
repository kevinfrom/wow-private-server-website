#!/usr/bin/env bash
set -e

VERSION="$(cat "./VERSION")"

read -p "Are you sure you want to build and push the Docker image for version $VERSION? (y/n): " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "Build cancelled."
    exit 1
fi

docker buildx build \
    --platform linux/amd64,linux/arm64 \
    --tag "ghcr.io/kevinfrom/wow-private-server-website:$VERSION" \
    --tag "ghcr.io/kevinfrom/wow-private-server-website:latest" \
    --push .
