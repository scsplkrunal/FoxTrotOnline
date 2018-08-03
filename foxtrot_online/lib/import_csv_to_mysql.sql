LOAD DATA LOCAL INFILE 'C:/Users/alonb/Desktop/FoxTrotOnline/foxtrot_online/company_abc/db/AcctPosTest6_20180730T192633.CSV'
INTO TABLE acctpos
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n"
IGNORE 1 LINES;