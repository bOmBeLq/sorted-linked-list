set -ex

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
echo $@

CMD='bash'
if [[ "$@" != "" ]]; then
  CMD=$@
fi
docker build -t sorted-linked-list-tester $SCRIPT_DIR/../
docker run -it -v `pwd`:/app -w /app sorted-linked-list-tester $CMD