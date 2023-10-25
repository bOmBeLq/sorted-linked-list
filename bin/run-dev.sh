#!/bin/bash
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
CMD='bash'
if [[ "$@" != "" ]]; then
  CMD=$@
fi
docker run -it -v $SCRIPT_DIR/../:/app -w /app -e PHP_CS_FIXER_IGNORE_ENV=1 sorted-linked-list-tester $CMD