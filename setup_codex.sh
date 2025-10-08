apt install pkg-config -y
apt install build-essentials -y

git clone https://github.com/openai/codex.git
cd codex/codex-rs

curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs/ | sh -s -- -y
source "$HOME/.cargo/env"
rustup component add rustfmt
rustup component add clippy

cargo build
