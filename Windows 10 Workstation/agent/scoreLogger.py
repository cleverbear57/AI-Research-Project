import time
import os
from bs4 import BeautifulSoup

# ================= CONFIG =================
WATCH_FILE = "/mnt/c/aeacus/assets/ScoringReport.html"
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
    Extract individual scored security issues from Aeacus HTML.
    Each issue is separated by <br> inside one <p>.
    """
    soup = BeautifulSoup(html, "html.parser")
    results = []

    # Find the scoring section header
    h3 = soup.find("h3", string=lambda s: s and "scored security issues fixed" in s)
    if not h3:
        return results

    # The list of issues is in the next <p>
    p = h3.find_next("p")
    if not p:
        return results

    # BeautifulSoup correctly separates text around <br>
    for text in p.stripped_strings:
        if "pts" in text:   # safety filter
            results.append(text)

    return results


def main():
    start_time = time.time()
    last_items = None

    while True:
        try:
            if not os.path.exists(WATCH_FILE):
                log_change(f"File '{WATCH_FILE}' not found.", start_time)
                time.sleep(CHECK_INTERVAL)
                continue

            with open(WATCH_FILE, "r", encoding="utf-8", errors="ignore") as f:
                html = f.read()

            current_items = set(extract_points(html))

            # First load establishes baseline
            if last_items is None:
                last_items = current_items
                log_change("Initial content loaded.", start_time)

            else:
                added = current_items - last_items
                removed = last_items - current_items

                for item in added:
                    log_change(f"Scored: {item}", start_time)

                for item in removed:
                    log_change(f"Unscored: {item}", start_time)

                last_items = current_items

        except Exception as e:
            log_change(f"Error: {e}", start_time)

        time.sleep(CHECK_INTERVAL)


if __name__ == "__main__":
    main()
