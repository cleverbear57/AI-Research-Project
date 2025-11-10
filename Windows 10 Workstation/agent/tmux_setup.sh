# run this in one terminal, and in another terminal, run watcher.sh.
#While watcher.sh is running, type, "Finished running everything" to test that it is working. Watcher.sh should send you continue and enter it.
tmux new -s codexsession
script -qef /tmp/codex_output.log
#put the prompt into AGENTS.md
#after you have done this, run "cargo run --bin codex -- --yolo"
#put the prompt as "Follow AGENTS.md, and when you are finished, output "Finished running everything""
