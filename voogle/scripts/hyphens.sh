#removes hypens
input="./files.txt"
while IFS= read -r var
do
	for file in "$var"/*;
 		do
		for i in *; 
		do 
			mv "$i" "$(echo "$i" | tr -d "'")";
		 done
	done;
done < "$input"

