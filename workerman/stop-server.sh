#!/bin/bash

# Mencari PID dari Workerman dan menghentikan prosesnya
pid=$(ps aux | grep 'WebSocketServer.php' | grep -v 'grep' | awk '{print $2}')

# Memeriksa apakah PID ditemukan
if [ -z "$pid" ]; then
  echo "Tidak ada server yang sedang berjalan."
else
  kill -9 $pid
  echo "Server Workerman dihentikan."
fi
