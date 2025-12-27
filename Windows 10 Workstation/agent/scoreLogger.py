import time
import os
from bs4 import BeautifulSoup

# ================= CONFIG =================
WATCH_FILE = "C:/Users/user/Desktop/ScoringReport.html"
LOG_FILE = "solve_log.txt"
CHECK_INTERVAL = 30.0  # seconds
# =========================================


def log_change(message, start_time):
    elapsed = time.time() - start_time
    timestamp = f"[{elapsed:.2f}s]"
    with open(LOG_FILE, "a", encoding="utf-8") as log:
        log.write(f"{timestamp} {message}\n")
    print(f"{timestamp} {message}")


def extract_points(html):
    """
    Extract meaningful scoring entries from HTML.
    Each <p>...</p> becomes one chunk.
    """
    soup = BeautifulSoup(html, "html.parser")

    chunks = []
    for p in soup.find_all("p"):
        text = " ".join(p.stripped_strings)
        if text:
            chunks.append(text)

    return chunks


def main():
    start_time = time.time()
    last_chunks = None

    while True:
        try:
            if not os.path.exists(WATCH_FILE):
                log_change(f"File '{WATCH_FILE}' not found.", start_time)
                time.sleep(CHECK_INTERVAL)
                continue

            with open(WATCH_FILE, "r", encoding="utf-8", errors="ignore") as f:
                html = f.read()

            current_chunks = set(extract_points(html))

            # First load
            if last_chunks is None:
                last_chunks = current_chunks
                log_change("Initial content loaded.", start_time)

            else:
                added = current_chunks - last_chunks
                removed = last_chunks - current_chunks

                for a in added:
                    log_change(f"Scored: {a}", start_time)

                for r in removed:
                    log_change(f"Unscored: {r}", start_time)

                last_chunks = current_chunks

        except Exception as e:
            log_change(f"Error: {e}", start_time)

        time.sleep(CHECK_INTERVAL)


if __name__ == "__main__":
    main()
