<?php
    $installer = $this;
    $installer->startSetup();

	
	$sql[] = "DROP TABLE IF EXISTS {$this->getTable('infeentynewsletter/newsletterfield')};";
	$sql[]= "CREATE TABLE IF NOT EXISTS {$this->getTable('infeentynewsletter/newsletterfield')} (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(50) NOT NULL,
  `field_title` varchar(150) NOT NULL,
  `field_form_id` int(11) NOT NULL,
  `field_type` varchar(20) NOT NULL,
  `field_size` int(11) NOT NULL,
  `field_required` tinyint(1) NOT NULL,
  `additional_info` text NOT NULL,
  `field_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `field_name` (`field_name`),
  KEY `field_form_id` (`field_form_id`,`field_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
   $sql[] = "DROP TABLE IF EXISTS {$this->getTable('infeentynewsletter/newsletterform')};";
   $sql[] = "
CREATE TABLE IF NOT EXISTS {$this->getTable('infeentynewsletter/newsletterform')} (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(100) NOT NULL,
  `form_title` varchar(150) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`form_id`),
  UNIQUE KEY `form_name` (`form_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

$sql[] ="ALTER TABLE {$this->getTable('infeentynewsletter/newsletterfield')}
  ADD CONSTRAINT `FORM_FIELD_ID".time()."` FOREIGN KEY (`field_form_id`) REFERENCES {$this->getTable('infeentynewsletter/newsletterform')} (`form_id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;";
	foreach($sql as $s) $installer->run($s);
	
    /* right before this */
    $installer->endSetup();
	