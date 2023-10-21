CMD='bash'
if [[ "$@" != "" ]]; then
  CMD=$@
fi
docker run -it -v `pwd`:/app -w /app -e PHP_CS_FIXER_IGNORE_ENV=1 sorted-linked-list-tester $CMD