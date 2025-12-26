import time
import os

# config
WATCH_FILE = "C:/Users/user/Desktop/ScoringReport.html"          # scoring report file
LOG_FILE = "solve_log.txt"      # timestamped log file
CHECK_INTERVAL = 30.0            # seconds between checks

def log_change(message, start_time): # commit change with timestamp
    elapsed = time.time() - start_time
    timestamp = f"[{elapsed:.2f}s]"
    with open(LOG_FILE, "a") as log:
        log.write(f"{timestamp} {message}\n")
    print(f"{timestamp} {message}")

def main():
    start_time = time.time()
    last_content = None

    while True:
        try:
            if os.path.exists(WATCH_FILE):
                with open(WATCH_FILE, "r") as f:
                    current_content = f.read()

                if last_content is None:
                    last_content = current_content
                    log_change("Initial content loaded.", start_time)

                elif current_content != last_content:
                    old_lines = last_content.splitlines()
                    new_lines = current_content.splitlines()

                    added_lines = [line for line in new_lines if line not in old_lines]
                    removed_lines = [line for line in old_lines if line not in new_lines]

                    if added_lines:
                        for line in added_lines:
                            log_change(f"Scored: {line}",start_time)
                    if removed_lines:
                        for line in removed_lines:
                            log_change(f"Unscored: {line}",start_time)

                    last_content = current_content
            else:
                log_change(f"File '{WATCH_FILE}' not found.", start_time)

        except Exception as e:
            log_change(f"Error: {e}", start_time)

        time.sleep(CHECK_INTERVAL)

if __name__ == "__main__":
    main()
