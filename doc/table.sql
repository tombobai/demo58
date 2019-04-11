/* 样例表 */
DROP TABLE IF EXISTS `yn_sample`;
CREATE TABLE IF NOT EXISTS `yn_sample` (
	`sample_id` char(32) NOT NULL default '',                            /*样例id*/
	`sample_name` varchar(100) NOT NULL default '',                      /*样例名称*/
	`sample_brief` varchar(1000) NOT NULL default '',                    /*样例简介*/
	`sample_content` text NOT NULL,                                        /*样例内容*/
	`sample_tags` varchar(100) NOT NULL default '',                      /*样例标签*/
	`doc_name` varchar(100) NOT NULL default '',                         /*文档原名*/
	`doc_size` int(10) NOT NULL default '0',                             /*文档大小*/
	`doc_ext` varchar(10) NOT NULL default '',                           /*文档后缀*/
	`doc_path` varchar(100) NOT NULL default '',                         /*文档路径*/
	`image_path` varchar(100) NOT NULL default '',                       /*图片路径*/
	`create_time` int(10) NOT NULL default '0',    					              /*创建时间*/
	`publish_time` int(10) NOT NULL default '0',    				              /*发布时间*/
	`status` tinyint(1) NOT NULL default '1',                             /*状态 1:启用; 2:禁用;*/
	`sample_type` smallint(6) NOT NULL default '0',                      /*样例类型*/
	`province_id` char(32) NOT NULL default '',
	`city_id` char(32) NOT NULL default '',
	`delete_flag` tinyint(1) NOT NULL default '1',                        /*删除标识 1:否; 2:是*/
	`display_order` smallint(6) NOT NULL default '1',
	`created_at` int(10) NOT NULL DEFAULT '0',                            /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                            /*修改时间*/
	PRIMARY KEY (`sample_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*省份表-样例使用*/
DROP TABLE IF EXISTS `yn_province`;
CREATE TABLE IF NOT EXISTS `yn_province` (
  `province_id` char(32) NOT NULL default '',
  `province_name` varchar(100) NOT NULL DEFAULT '',
  `display_order` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(10) NOT NULL DEFAULT '0',                          /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                          /*修改时间*/
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*城市表-样例使用 */
DROP TABLE IF EXISTS `yn_city`;
CREATE TABLE IF NOT EXISTS `yn_city` (
	`city_id` char(32) NOT NULL default '',                              /*城市id*/
	`province_id` char(32) NOT NULL default '',                          /*省份id*/
	`city_name` varchar(100) NOT NULL default '',                        /*城市名称*/
	`display_order` smallint(6) NOT NULL default '1',
	`created_at` int(10) NOT NULL DEFAULT '0',                           /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                           /*修改时间*/
	PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* 管理员信息表 */
DROP TABLE IF EXISTS `yn_admin`;
CREATE TABLE IF NOT EXISTS `yn_admin` (
  `admin_id` char(32) NOT NULL default '',
  `telephone` varchar(40) NOT NULL default '',                           /*管理员手机号*/
  `true_name` varchar(30) NOT NULL default '',                           /*真实姓名*/
  `admin_password` varchar(32) NOT NULL default '',                      /*管理员密码*/
  `salt` varchar(6) NOT NULL default '',                                 /*六位随机数，用于密码加密*/
  `my_password` varchar(32) NOT NULL default '',                         /*加上随机数后的密码加密*/
  `role_id` char(32) NOT NULL default '',         					               /*所属角色ID*/
  `admin_last_time` int(10) NOT NULL default '0',    					           /*最后登录时间*/
  `admin_last_ip` varchar(15) NOT NULL default '',   					           /*最后登录IP*/
  `created_at` int(10) NOT NULL DEFAULT '0',                              /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                              /*修改时间*/
  PRIMARY KEY (`admin_id`),
  KEY (`telephone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* 权限信息表 */
DROP TABLE IF EXISTS `yn_permission`;
CREATE TABLE IF NOT EXISTS `yn_permission` (
  `permission_id` char(32) NOT NULL default '',
  `permission_name` varchar(20) NOT NULL default '',  					          /*权限名称*/
  `permission_flag` tinyint(1) NOT NULL default '1',  					          /*权限标识 1:后台权限; 2:APP权限*/
  `permission_type` tinyint(1) NOT NULL default '1',                     /*权限类型 1:菜单; 2:操作*/
  `parent_id` char(32) NOT NULL default '',        			                /*父ID*/
  `permission_url` varchar(100) NOT NULL default '',   					        /*权限链接*/
  `permission_key` varchar(20) NOT NULL default '',  					          /*权限关键字*/
  `display_order` smallint(6) NOT NULL default '1',                     /*菜单显示顺序，越大越靠后*/
  `created_at` int(10) NOT NULL DEFAULT '0',                             /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                             /*修改时间*/
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* 角色表 */
DROP TABLE IF EXISTS `yn_role`;
CREATE TABLE IF NOT EXISTS `yn_role` (
  `role_id` char(32) NOT NULL default '',
  `role_name` varchar(20) NOT NULL default '',       					         /*角色名称*/
  `role_brief` varchar(200) NOT NULL default '',                		     /*角色简介*/
  `permission_ids` text NULL, 					                                   /*拥有的权限ID串*/
  `created_at` int(10) NOT NULL DEFAULT '0',                            /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                            /*修改时间*/
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* 配置表 */
DROP TABLE IF EXISTS `yn_config`;
CREATE TABLE IF NOT EXISTS `yn_config` (
	`config_id` char(32) NOT NULL default '',
	`config_param` varchar(50) NOT NULL default '',                       /*参数名称*/
	`config_value` text NOT NULL,                                           /*参数值*/
	`created_at` int(10) NOT NULL DEFAULT '0',                            /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                            /*修改时间*/
	PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*省份表*/
DROP TABLE IF EXISTS `yn_province`;
CREATE TABLE IF NOT EXISTS `yn_province` (
  `province_id` char(32) NOT NULL default '',
  `province_name` varchar(100) NOT NULL DEFAULT '',
  `display_order` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(10) NOT NULL DEFAULT '0',                          /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                          /*修改时间*/
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*城市表 */
DROP TABLE IF EXISTS `yn_city`;
CREATE TABLE IF NOT EXISTS `yn_city` (
	`city_id` char(32) NOT NULL default '',                              /*城市id*/
	`province_id` char(32) NOT NULL default '',                          /*省份id*/
	`city_name` varchar(100) NOT NULL default '',                        /*城市名称*/
	`display_order` smallint(6) NOT NULL default '1',
	`created_at` int(10) NOT NULL DEFAULT '0',                           /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                           /*修改时间*/
	PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* 样例表 */
DROP TABLE IF EXISTS `yn_sample`;
CREATE TABLE IF NOT EXISTS `yn_sample` (
	`sample_id` char(32) NOT NULL default '',                            /*样例id*/
	`sample_name` varchar(100) NOT NULL default '',                      /*样例名称*/
	`sample_brief` varchar(1000) NOT NULL default '',                    /*样例简介*/
	`sample_content` text NOT NULL,                                        /*样例内容*/
	`sample_tags` varchar(100) NOT NULL default '',                      /*样例标签*/
	`doc_name` varchar(100) NOT NULL default '',                         /*文档原名*/
	`doc_size` int(10) NOT NULL default '0',                             /*文档大小*/
	`doc_ext` varchar(10) NOT NULL default '',                           /*文档后缀*/
	`doc_path` varchar(100) NOT NULL default '',                         /*文档路径*/
	`image_path` varchar(100) NOT NULL default '',                       /*图片路径*/
	`create_time` int(10) NOT NULL default '0',    					              /*创建时间*/
	`publish_time` int(10) NOT NULL default '0',    				              /*发布时间*/
	`status` tinyint(1) NOT NULL default '1',                             /*状态 1:启用; 2:禁用;*/
	`sample_type` smallint(6) NOT NULL default '0',                      /*样例类型*/
	`province_id` char(32) NOT NULL default '',
	`city_id` char(32) NOT NULL default '',
	`display_order` smallint(6) NOT NULL default '1',
	`created_at` int(10) NOT NULL DEFAULT '0',                            /*创建时间*/
  `updated_at` int(10) NOT NULL DEFAULT '0',                            /*修改时间*/
	PRIMARY KEY (`sample_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;