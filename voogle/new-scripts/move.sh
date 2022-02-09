inotifywait -m -r -e move --format "%e %w %f" /test |
  while read evt dir file; do
    #echo "Event: $evt, Dir: $dir, File: $file"
    if [ $evt = "MOVED_FROM" ];then
    	#echo "MOVED FROM $dir"
    	original_file="$dir$file"
    else
    	#echo "Moved to $dir"
    	new_file="$dir$file"
    	sh /test/command.sh "$original_file" "$new_file"
    fi
    #echo "Fullpath: $dir $file" #note the space between $dir and $file
    #sh /test/command.sh "$original_file" "$new_file"
done
