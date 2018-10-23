# Return lines from a file

Simple really. This is the third time I had to run a batch process and thought a tool like this would be helpful.

## Examples/Ideas

`[GET] /?file=records.csv&interval=10`
Get 10 lines from `records.csv`. Subsequent requests should start at interval \* called.

`[GET] /new`
Upload a new file form.

`[POST] /new?s=1`
Upload a new file. The endpoint will get the filename from the posted file. (Spaces should be converted to `-`!)

`[GET] /?file=records.csv&start=10&end=max`
Get all lines from a file beginning at line 10 and ending at max.
