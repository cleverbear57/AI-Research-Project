#!/usr/bin/env bash
TARGET="codexsession:0"
LOGFILE="/tmp/codex_output.log"
PATTERN='Finished running everything'
#After already ran script -qef /tmp/codex_output.log
touch "$LOGFILE"
tail -n 0 -F "$LOGFILE" | while IFS= read -r line; do
  if echo "$line" | grep -qiE "$PATTERN"; then
    tmux send-keys -t "$TARGET" 'continue'
    tmux send-keys -t "$TARGET" Enter
    echo "[watcher] sent Enter at $(date)" >&2
  fi
done
