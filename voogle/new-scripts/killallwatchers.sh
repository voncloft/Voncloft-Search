kill -9 $(ps aux | grep inotify | cut -d ' ' -f6)
