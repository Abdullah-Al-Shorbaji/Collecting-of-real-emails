create table doc_collected_emails (
									email_id 		int(10) 		primary key, 
                                    email_text 		varchar(300) 	not null, 
                                    is_active 		int(1) 			not null default 1, 
                                    creation_date 	timestamp 		not null default current_timestamp
                                    )