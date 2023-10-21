CMD='bash'
if [[ "$@" != "" ]]; then
  CMD=$@
fi
docker run -it -v `pwd`:/app -w /app sorted-linked-list-tester $CMD