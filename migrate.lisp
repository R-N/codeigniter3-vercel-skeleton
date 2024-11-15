/* content of the script.lisp */
LOAD DATABASE 
FROM mysql://root:@localhost:3306/raja-laundry 
INTO postgres://postgres:@localhost:5432/postgres?sslmode=allow 
WITH include drop, create tables, create indexes, reset sequences 
;
