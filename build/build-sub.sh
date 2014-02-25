eps=$1

if [ x"$1" == x ]
  then
  echo Usage: $0 "<episode>"
  exit 1
fi

eps=`printf %03d $eps`
dir=${eps:0:2}

./merge.php layout.ass ../$dir/$eps*.ass > $eps.ass