<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("

DROP TABLE IF EXISTS inkatia_blog_comments;
DROP TABLE IF EXISTS inkatia_blog;

                
CREATE TABLE inkatia_blog (
  inkatia_blog_id int(11) NOT NULL auto_increment,
  featured_image varchar(255) NOT NULL,	
  title varchar(255) NOT NULL,
  content_tinymce text NOT NULL,
  status smallint(6) NOT NULL,
  created_time datetime NULL,
  update_time datetime NULL,
  PRIMARY KEY (inkatia_blog_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE inkatia_blog_comments (
  inkatia_blog_comment_id int(11) NOT NULL auto_increment,
  inkatia_blog_id int(11) NOT NULL,
  user_id int(11) NOT NULL,        
  comment text NOT NULL,
  status smallint(6) NOT NULL,
  created_time datetime NULL,
  update_time datetime NULL,
  PRIMARY KEY (inkatia_blog_comment_id),
  FOREIGN KEY (inkatia_blog_id) REFERENCES inkatia_blog(inkatia_blog_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");
 
$installer->endSetup();