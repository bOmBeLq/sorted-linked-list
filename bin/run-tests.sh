SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

TESTS='tests'
if [[ "$@" != "" ]]; then
  TESTS=$@
fi

$SCRIPT_DIR/run-dev.sh vendor/bin/phpunit $TESTS