#!/bin/bash
set -e
cd "`dirname $0`"
# rm -rf target
cargo build --all --target wasm32-unknown-unknown --release
cp target/wasm32-unknown-unknown/release/*.wasm ./res/
