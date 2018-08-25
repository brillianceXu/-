<?php 
$sql="CREATE TABLE IF NOT EXISTS `ims_fy_lesson_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `author` varchar(100) DEFAULT NULL COMMENT '作者',
  `content` text COMMENT '内容',
  `linkurl` varchar(1000) DEFAULT NULL COMMENT '原文链接',
  `images` varchar(255) DEFAULT NULL COMMENT '分享图片',
  `desc` text NOT NULL COMMENT '分享描述',
  `isshow` tinyint(1) DEFAULT '1' COMMENT '前台展示 0.关闭 1.开启',
  `displayorder` varchar(255) DEFAULT '0' COMMENT '排序 数值越大越靠前',
  `view` int(11) NOT NULL DEFAULT '0' COMMENT '访问量',
  `addtime` int(10) DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_title` (`title`),
  KEY `idx_author` (`author`),
  KEY `idx_isshow` (`isshow`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章公告';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_banner` (
  `banner_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号编号',
  `banner_name` varchar(255) DEFAULT NULL COMMENT '广告位名称',
  `picture` varchar(255) NOT NULL COMMENT '图片路径',
  `link` varchar(255) DEFAULT NULL COMMENT '图片链接',
  `is_pc` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0.移动端 1.PC端',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0.不显示 1.显示',
  `banner_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '图片类型 0.首页轮播图 1.底部课程广告',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='图片表';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_blacklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `uid` int(11) DEFAULT NULL COMMENT '会员编号',
  `addtime` int(10) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`uid`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='黑名单';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_cashlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `cash_type` tinyint(1) NOT NULL COMMENT '提现方式 1.管理员审核 2.自动到账',
  `cash_way` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1.提现到余额  2.提现到微信钱包 3.提现到支付宝',
  `pay_account` varchar(50) DEFAULT NULL COMMENT '提现帐号',
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `openid` varchar(255) NOT NULL COMMENT '粉丝编号',
  `cash_num` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0.待审核 1.提现成功 -1.审核未通过',
  `disposetime` int(10) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `partner_trade_no` varchar(255) DEFAULT NULL COMMENT '商户订单号',
  `payment_no` varchar(255) DEFAULT NULL COMMENT '微信订单号',
  `remark` text COMMENT '管理员备注',
  `lesson_type` tinyint(1) NOT NULL COMMENT '提现类型 1.分销佣金提现 2.课程收入提现',
  `addtime` int(10) NOT NULL COMMENT '申请时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cash_type` (`cash_type`),
  KEY `idx_cash_way` (`cash_way`),
  KEY `idx_uid` (`uid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_status` (`status`),
  KEY `idx_lesson_type` (`lesson_type`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='佣金提现';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `ico` varchar(255) DEFAULT NULL COMMENT '分类图标',
  `link` varchar(1000) DEFAULT NULL COMMENT '自定义链接',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示在首页(仅对一级分类生效)',
  `addtime` int(10) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='课程分类';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_code` (
  `code_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `mobile` varchar(20) NOT NULL COMMENT '手机号码',
  `code` varchar(10) NOT NULL COMMENT '验证码',
  `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否使用 0.未使用 1.已使用',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='验证码';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `outid` int(11) NOT NULL COMMENT '外部编号(课程编号或讲师编号)',
  `ctype` tinyint(1) NOT NULL COMMENT '收藏类型 1.课程 2.讲师',
  `addtime` int(10) NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_ctype` (`ctype`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='收藏';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_commission_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `levelname` varchar(50) DEFAULT NULL COMMENT '分销等级名称',
  `commission1` decimal(10,2) DEFAULT '0.00' COMMENT '一级分销佣金比例',
  `commission2` decimal(10,2) DEFAULT '0.00' COMMENT '二级分销佣金比例',
  `commission3` decimal(10,2) DEFAULT '0.00' COMMENT '三级分销佣金比例',
  `updatemoney` decimal(10,2) DEFAULT '0.00' COMMENT '升级条件(分销佣金满多少)',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_levelname` (`levelname`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='分销等级';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_commission_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `orderid` varchar(255) DEFAULT NULL COMMENT '订单id',
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `nickname` varchar(100) DEFAULT NULL COMMENT '会员昵称',
  `bookname` varchar(255) DEFAULT NULL COMMENT '课程名称',
  `change_num` decimal(10,2) DEFAULT '0.00' COMMENT '变动数目',
  `grade` tinyint(1) DEFAULT NULL COMMENT '佣金等级',
  `remark` varchar(255) DEFAULT NULL COMMENT '变动说明',
  `addtime` int(10) DEFAULT NULL COMMENT '变动时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_orderid` (`orderid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_nickname` (`nickname`),
  KEY `idx_bookname` (`bookname`),
  KEY `idx_grade` (`grade`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='佣金日志';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_commission_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `vip_sale` tinyint(1) DEFAULT '0' COMMENT 'VIP订单分销开关',
  `vipdesc` text COMMENT 'vip服务描述',
  `sharelink` text COMMENT '链接分享',
  `sharelesson` text COMMENT '分享课程',
  `shareteacher` text COMMENT '分享讲师',
  `is_sale` tinyint(1) DEFAULT '0' COMMENT '分销功能 0.关闭 1.开启',
  `self_sale` tinyint(1) DEFAULT '0' COMMENT '分销内购 0.关闭 1.开启',
  `sale_rank` tinyint(1) DEFAULT '1' COMMENT '分销身份 1.任何人 2.VIP身份',
  `commission` text COMMENT '默认课程佣金比例',
  `level` tinyint(1) DEFAULT '3' COMMENT '分销等级',
  `cash_type` tinyint(1) DEFAULT '1' COMMENT '提现处理方式 1.管理员审核 2.自动到账',
  `cash_way` text COMMENT '提现方式',
  `cash_lower_vip` decimal(10,2) DEFAULT '1.00' COMMENT 'VIP提现最低额度 0.关闭',
  `mchid` varchar(50) DEFAULT NULL COMMENT '微信支付商户号',
  `mchkey` varchar(50) DEFAULT NULL COMMENT '微信支付商户支付密钥',
  `serverIp` varchar(20) DEFAULT NULL COMMENT '服务器Ip',
  `agent_status` tinyint(1) DEFAULT '1' COMMENT '分销商状态 0.关闭 1.开启 2.冻结',
  `agent_condition` text COMMENT '分销商条件 1.消费金额满x元  2.消费订单满x笔  3.注册满x天',
  `sale_desc` text COMMENT '推广海报页面说明',
  `rec_income` text COMMENT '直接推荐奖励',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `cash_lower_common` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '普通用户最低提现额度 0.为关闭',
  `cash_lower_teacher` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '讲师最低提现额度 0.关闭',
  `qrcode_cache` tinyint(1) NOT NULL DEFAULT '1' COMMENT '会员海报缓存 0.不缓存  1.缓存',
  `upgrade_condition` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分销升级条件 1.累计佣金 2.支付订单额 3.支付订单笔数',
  `font` text COMMENT '分享文字(以json格式保存)',
  `hidden_sale` tinyint(1) NOT NULL DEFAULT '0' COMMENT '隐藏前台分销按钮 0.否 1.是',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='分销设置表';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_coupon` (
  `card_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `password` varchar(18) NOT NULL COMMENT '优惠码密钥',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠码面值',
  `validity` int(10) NOT NULL COMMENT '有效期',
  `conditions` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用条件(满x元可用)',
  `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0.未使用 1.已使用',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `uid` int(11) DEFAULT NULL COMMENT '会员编号',
  `ordersn` varchar(50) DEFAULT NULL COMMENT '订单编号',
  `use_time` int(10) DEFAULT NULL COMMENT '使用时间',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`card_id`),
  UNIQUE KEY `idx_ordersn` (`ordersn`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_password` (`password`),
  KEY `idx_uid` (`uid`),
  KEY `idx_validity` (`validity`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8 COMMENT='课程优惠码';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_discount` (
  `discount_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned DEFAULT NULL COMMENT '公众号编号',
  `title` varchar(255) DEFAULT NULL COMMENT '活动标题',
  `content` text COMMENT '活动描述内容',
  `member_discount` tinyint(1) NOT NULL DEFAULT '0' COMMENT '同时享受会员折扣 0.否 1.是',
  `starttime` int(11) DEFAULT NULL COMMENT '开始时间',
  `endtime` int(11) DEFAULT NULL COMMENT '结束时间',
  `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='限时折扣活动';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_discount_lesson` (
  `discount_lesson_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号编号',
  `discount_id` int(11) DEFAULT NULL COMMENT '折扣活动编号',
  `lesson_id` int(11) DEFAULT NULL COMMENT '课程编号',
  `discount` int(4) DEFAULT '0' COMMENT '课程折扣 单位%',
  `member_discount` tinyint(1) DEFAULT '0' COMMENT '同时享受会员折扣 0.否 1.是',
  `starttime` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endtime` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `addtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`discount_lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='限时折扣课程';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_evaluate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `orderid` int(11) unsigned NOT NULL COMMENT '订单id',
  `ordersn` varchar(255) NOT NULL COMMENT '订单编号',
  `lessonid` int(11) NOT NULL COMMENT '课程id',
  `bookname` varchar(255) NOT NULL COMMENT '课程名称',
  `teacherid` int(11) DEFAULT NULL COMMENT '讲师id(与haoshu_teacher表的id字段对应)',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `nickname` varchar(50) NOT NULL COMMENT '会员昵称',
  `grade` tinyint(1) NOT NULL COMMENT '评价 1.好评 2.中评 3.差评',
  `content` text NOT NULL COMMENT '评价内容',
  `reply` text COMMENT '评价回复',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论状态 -1.审核未通过 0.待审核 1.审核通过',
  `addtime` int(10) NOT NULL COMMENT '评价时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_orderid` (`orderid`),
  KEY `idx_ordersn` (`ordersn`),
  KEY `idx_lessonid` (`lessonid`),
  KEY `idx_bookname` (`bookname`),
  KEY `idx_teacherid` (`teacherid`),
  KEY `idx_grade` (`grade`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评价课程';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `lessonid` int(11) NOT NULL COMMENT '课程id',
  `addtime` int(10) NOT NULL COMMENT '最后进入时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='课程足迹';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_inform` (
  `inform_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `lesson_id` int(11) DEFAULT NULL COMMENT '课程id',
  `book_name` varchar(255) DEFAULT NULL COMMENT '课程名称',
  `content` text COMMENT '模版消息内容(json格式保存)',
  `user_type` tinyint(1) DEFAULT NULL COMMENT '用户类型 1.全部会员 2.VIP会员 3.购买过该讲师的会员',
  `inform_number` int(11) DEFAULT NULL COMMENT '发送总量',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态 1.发送中 0.发送完毕',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`inform_id`),
  KEY `uniacid` (`uniacid`),
  KEY `lesson_id` (`lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='课程通知主表';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_inform_fans` (
  `inform_fans_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `inform_id` int(11) DEFAULT NULL COMMENT '通知id',
  `openid` varchar(50) DEFAULT NULL COMMENT '粉丝编号',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`inform_fans_id`),
  KEY `uniacid` (`uniacid`),
  KEY `inform_id` (`inform_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='课程通知粉丝表';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_market` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `deduct_switch` tinyint(1) DEFAULT '0' COMMENT '积分抵扣开关',
  `deduct_money` decimal(10,2) DEFAULT '0.00' COMMENT '1积分抵扣金额',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `reg_give` text COMMENT '注册赠送优惠券',
  `recommend` text COMMENT '推荐下级赠送优惠券',
  `recommend_time` int(11) NOT NULL DEFAULT '0' COMMENT '最多可获取次数 0.不限制',
  `buy_lesson` text COMMENT '购买课程赠送优惠券',
  `buy_lesson_time` int(11) NOT NULL DEFAULT '0' COMMENT '最多可获取次数 0.不限制',
  `share_lesson` text COMMENT '分享课程赠送优惠券',
  `share_lesson_time` int(11) NOT NULL DEFAULT '0' COMMENT '最多可获取次数 0.不限制',
  `coupon_desc` text COMMENT '优惠券页面说明',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_mcoupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `amount` decimal(10,2) DEFAULT '0.00' COMMENT '优惠券面值',
  `images` varchar(255) NOT NULL COMMENT ' 优惠券封面图',
  `validity_type` text COMMENT '有效期 1.固定有效期 2.自增有效期',
  `days1` int(11) NOT NULL COMMENT '固定有效期',
  `days2` int(11) NOT NULL COMMENT '自增有效期(天)',
  `conditions` decimal(10,2) DEFAULT '0.00' COMMENT '使用条件 满x元可使用',
  `is_exchange` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支持积分兑换 0.不支持 1.支持',
  `exchange_integral` int(11) NOT NULL COMMENT '每张优惠券兑换积分',
  `max_exchange` int(11) NOT NULL COMMENT '每位用户最大兑换数量',
  `total_exchange` int(11) NOT NULL COMMENT '总共优惠券张数',
  `already_exchange` int(11) NOT NULL COMMENT '已兑换数量',
  `category_id` int(11) DEFAULT NULL COMMENT '使用条件 指定分类课程使用 0.为全部课程',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态 0.下架 1.上架',
  `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `receive_link` tinyint(1) NOT NULL DEFAULT '0' COMMENT '链接领取 0.不支持 1.支持',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='优惠券';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `nickname` varchar(100) DEFAULT NULL COMMENT '昵称',
  `studentno` varchar(20) DEFAULT NULL COMMENT '会员号',
  `gohome` tinyint(1) NOT NULL DEFAULT '0' COMMENT '学员是否进群 0.未进群 1.已进群',
  `openid` varchar(255) DEFAULT NULL COMMENT '粉丝标识',
  `parentid` int(11) DEFAULT NULL COMMENT '推荐人id',
  `leaderunion` tinyint(1) NOT NULL DEFAULT '0' COMMENT '联合发起人身份 0.否 1.是',
  `nopay_commission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '未结算佣金',
  `pay_commission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '已结算佣金',
  `nopay_lesson` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '未提现课程收入',
  `pay_lesson` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '已提现课程收入',
  `vip` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否vip 0.否 1.是',
  `validity` bigint(11) NOT NULL DEFAULT '0' COMMENT 'vip有效期',
  `pastnotice` int(10) NOT NULL DEFAULT '0' COMMENT 'vip服务过期前最新通知时间',
  `agent_level` int(11) NOT NULL DEFAULT '0' COMMENT '分销代理级别',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分销状态 0.冻结 1.开启',
  `uptime` int(10) NOT NULL COMMENT '更新时间',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `payment_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '购买订单总额',
  `payment_order` int(11) NOT NULL DEFAULT '0' COMMENT '购买订单笔数',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_parentid` (`parentid`),
  KEY `idx_vip` (`vip`),
  KEY `idx_validity` (`validity`),
  KEY `idx_pastnotice` (`pastnotice`),
  KEY `idx_status` (`status`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='会员信息';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_member_coupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `amount` decimal(10,2) DEFAULT '0.00' COMMENT '优惠券面值',
  `conditions` decimal(10,2) DEFAULT '0.00' COMMENT '使用条件',
  `validity` int(11) DEFAULT NULL COMMENT '有效期',
  `category_id` int(11) NOT NULL COMMENT '指定分类课程可用',
  `password` varchar(100) DEFAULT NULL COMMENT '优惠券密码(优惠码转换过来的)',
  `ordersn` varchar(100) DEFAULT NULL COMMENT '使用订单号',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态 -1.已过期 0.未使用 1.已使用',
  `source` tinyint(1) NOT NULL COMMENT '来源 1.优惠码转换 2.购买课程赠送 3.邀请下级成员赠送 4.分享课程赠送 5.积分兑换',
  `coupon_id` int(11) DEFAULT NULL COMMENT '优惠券id(兑换)',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `validity` (`validity`),
  KEY `status` (`status`),
  KEY `source` (`source`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员优惠券';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_member_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `acid` int(11) DEFAULT '0',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `ordersn` varchar(255) NOT NULL COMMENT '订单编号',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `level_id` int(11) NOT NULL COMMENT 'vip会员等级id(与fy_lesson_vip_level表id对应)',
  `level_name` varchar(255) DEFAULT NULL COMMENT 'VIP等级名称',
  `viptime` decimal(10,2) DEFAULT NULL COMMENT '会员服务时间',
  `vipmoney` decimal(10,2) NOT NULL COMMENT '会员服务价格',
  `paytype` varchar(50) NOT NULL COMMENT '支付方式',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态 0.未支付 1.已支付',
  `paytime` int(10) DEFAULT '0' COMMENT '订单支付时间',
  `member1` int(11) NOT NULL COMMENT '一级代理会员id',
  `commission1` decimal(10,2) NOT NULL COMMENT '一级代理佣金',
  `member2` int(11) NOT NULL COMMENT '二级代理会员id',
  `commission2` decimal(10,2) NOT NULL COMMENT '二级代理佣金',
  `member3` int(11) NOT NULL COMMENT '三级代理会员id',
  `commission3` decimal(10,2) NOT NULL COMMENT '三级代理佣金',
  `refer_id` int(11) DEFAULT NULL COMMENT '充值卡id(与vip卡的id对应)',
  `addtime` int(10) NOT NULL COMMENT '订单添加时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '赠送积分',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_paytype` (`paytype`),
  KEY `idx_status` (`status`),
  KEY `idx_refer_id` (`refer_id`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='VIP订单';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_member_recommend` (
  `recommend_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号编号',
  `unionid` varchar(255) NOT NULL COMMENT '会员unionid',
  `parentid` int(11) NOT NULL COMMENT '推荐人编号',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`recommend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推荐会员表';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_member_vip` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `level_id` int(11) DEFAULT NULL COMMENT 'vip等级id',
  `validity` int(11) DEFAULT NULL COMMENT '有效期',
  `discount` int(4) DEFAULT '100' COMMENT '折扣',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='已购买VIP';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `acid` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `ordersn` varchar(255) NOT NULL COMMENT '订单编号',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `lessonid` int(11) NOT NULL COMMENT '课程id',
  `bookname` varchar(255) NOT NULL COMMENT '课程名称',
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `coupon` varchar(50) DEFAULT NULL COMMENT '课程优惠码',
  `coupon_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠码面值',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程价格',
  `spec_day` int(4) DEFAULT NULL COMMENT '课程规格(多少天内有效)',
  `teacherid` int(11) DEFAULT NULL COMMENT '讲师id(与haoshu_teacher表的id字段对应)',
  `teacher_income` tinyint(3) NOT NULL DEFAULT '0' COMMENT '讲师收入(课程价格分成%)',
  `integral` int(4) NOT NULL DEFAULT '0' COMMENT '赠送积分',
  `deduct_integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分抵扣数量',
  `invoice` varchar(100) DEFAULT NULL COMMENT '发票',
  `paytype` varchar(50) NOT NULL DEFAULT '0' COMMENT '支付方式',
  `paytime` int(10) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `validity` int(11) NOT NULL DEFAULT '0' COMMENT '有效期 在有效期内可观看学习课程',
  `member1` int(11) NOT NULL DEFAULT '0' COMMENT '一级代理会员id',
  `commission1` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级佣金',
  `member2` int(11) NOT NULL DEFAULT '0' COMMENT '二级代理会员id',
  `commission2` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级佣金',
  `member3` int(11) NOT NULL DEFAULT '0' COMMENT '三级代理会员id',
  `commission3` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级佣金',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态 -1.已取消 0.未支付 1.已支付 2.已评价',
  `addtime` int(10) DEFAULT NULL COMMENT '下单时间',
  `lesson_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程类型 0.普通课程  1.预约课程',
  `appoint_info` text COMMENT '预约信息(json格式保存)',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`),
  KEY `idx_acid` (`acid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_ordersn` (`ordersn`),
  KEY `idx_uid` (`uid`),
  KEY `idx_lessonid` (`lessonid`),
  KEY `idx_bookname` (`bookname`),
  KEY `idx_teacherid` (`teacherid`),
  KEY `idx_paytype` (`paytype`),
  KEY `idx_status` (`status`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='课程订单';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_order_detail` (
  `order_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL COMMENT '订单id',
  `real_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号码',
  `receive_date` date DEFAULT NULL COMMENT '指定日期',
  `receive_address` varchar(255) DEFAULT NULL COMMENT '地址',
  `remark` text COMMENT '备注',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`order_detail_id`),
  KEY `uniacid` (`uniacid`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单详情表';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_parent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `pid` int(11) DEFAULT NULL COMMENT '父分类id',
  `cid` int(11) NOT NULL COMMENT '分类ID',
  `bookname` varchar(255) NOT NULL COMMENT '课程名称',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程价格',
  `isdiscount` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启该课程折扣',
  `vipdiscount` int(3) NOT NULL DEFAULT '0' COMMENT 'vip会员折扣',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '购买赠送积分',
  `deduct_integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分最多抵扣数量',
  `images` varchar(255) DEFAULT NULL COMMENT '课程封图',
  `poster` text COMMENT '视频播放封面图',
  `descript` longtext COMMENT '课程介绍',
  `difficulty` varchar(100) DEFAULT NULL COMMENT '课程难度',
  `stock` int(11) NOT NULL COMMENT '库存',
  `buynum` int(11) NOT NULL DEFAULT '0' COMMENT '正常购买人数',
  `virtual_buynum` int(11) NOT NULL DEFAULT '0' COMMENT '虚拟购买人数',
  `score` decimal(5,2) NOT NULL COMMENT '课程好评率',
  `teacherid` int(11) NOT NULL COMMENT '主讲老师id',
  `commission` text COMMENT '佣金比例',
  `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '课程排序',
  `status` tinyint(1) NOT NULL COMMENT '课程状态 -1.暂停销售 0.下架 1.上架 2.审核中',
  `recommendid` varchar(255) DEFAULT NULL COMMENT '推荐板块id',
  `vipview` varchar(100) DEFAULT NULL COMMENT '免费学习的VIP等级集合',
  `teacher_income` tinyint(3) NOT NULL DEFAULT '0' COMMENT '讲师分成%',
  `link` varchar(1000) DEFAULT NULL COMMENT '自定义链接',
  `validity` int(11) NOT NULL DEFAULT '0' COMMENT '有效期 即购买时起多少天内有效',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `share` text COMMENT '分享信息',
  `support_coupon` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否支持优惠券抵扣 0.不支持 1.支持',
  `integral_rate` decimal(5,2) DEFAULT '0.00' COMMENT '赠送积分比例',
  `visit_number` int(11) NOT NULL DEFAULT '0' COMMENT '访问人数',
  `update_time` int(11) DEFAULT NULL COMMENT '章节最后更新时间',
  `ico_name` varchar(100) DEFAULT NULL COMMENT '课程标识',
  `lesson_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程类型 0.普通课程  1.预约课程',
  `appoint_info` text COMMENT '预约信息(json格式保存)',
  `section_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '连载状态 0.更新中 1.已完结',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cid` (`cid`),
  KEY `idx_bookname` (`bookname`),
  KEY `idx_teacherid` (`teacherid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_status` (`status`),
  KEY `idx_recommendid` (`recommendid`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='课程主表';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_playrecord` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `lessonid` int(11) DEFAULT NULL COMMENT '课程id',
  `sectionid` int(11) DEFAULT NULL COMMENT '章节id',
  `playtime` int(11) NOT NULL DEFAULT '0' COMMENT '上次播放时间 单位：秒',
  `addtime` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='播放记录';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_qcloud_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `teacherid` int(11) DEFAULT NULL COMMENT '讲师id(讲师id为空表示后台上传)',
  `name` varchar(500) DEFAULT NULL COMMENT '文件名称',
  `com_name` varchar(1000) DEFAULT NULL COMMENT '完整文件名',
  `sys_link` varchar(1000) DEFAULT NULL COMMENT '原始链接',
  `size` decimal(10,2) DEFAULT NULL COMMENT '视频大小',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='腾讯云存储文件';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_qiniu_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `uid` int(11) DEFAULT NULL COMMENT '会员编号',
  `openid` varchar(255) DEFAULT NULL COMMENT '粉丝编号',
  `teacher` int(11) DEFAULT NULL COMMENT '讲师编号',
  `name` varchar(500) DEFAULT NULL COMMENT '文件名',
  `com_name` varchar(1000) DEFAULT NULL COMMENT '完成文件名',
  `qiniu_url` varchar(1000) DEFAULT NULL COMMENT '文件链接',
  `size` varchar(100) DEFAULT NULL COMMENT '文件大小',
  `addtime` int(10) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_teacher` (`teacher`),
  KEY `idx_name` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='七牛上传记录';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_recommend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `rec_name` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `show_style` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示样式 1.单课程模式 2.课程+专题模式 3.专题模式',
  `displayorder` int(4) DEFAULT NULL COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `limit_number` int(4) NOT NULL DEFAULT '6' COMMENT '首页显示数量',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_is_show` (`is_show`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推荐板块';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `logo` varchar(255) NOT NULL COMMENT 'app端logo',
  `manageopenid` text NOT NULL COMMENT '新订单提醒(管理员)',
  `sitename` varchar(100) DEFAULT NULL,
  `banner` text COMMENT '焦点图',
  `adv` text NOT NULL COMMENT '课程详情页广告',
  `copyright` varchar(255) NOT NULL COMMENT '版权',
  `closespace` int(4) NOT NULL DEFAULT '60' COMMENT '关闭未付款订单时间间隔',
  `closelast` int(10) NOT NULL DEFAULT '0' COMMENT '上次执行关闭未付款订单时间',
  `savetype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0.其他存储方式 1.七牛云存储 2.腾讯云存储',
  `qiniu` text NOT NULL COMMENT '七牛云存储参数',
  `qcloud` text COMMENT '腾讯云存储',
  `vipdiscount` int(3) NOT NULL DEFAULT '0' COMMENT 'vip会员购买课程折扣',
  `teacher_income` tinyint(1) NOT NULL DEFAULT '0' COMMENT '讲师申请 0.关闭 1.开启',
  `isfollow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '引导关注公众号 0.关闭 1.开启',
  `qrcode` varchar(255) DEFAULT NULL COMMENT '公众号二维码',
  `mustinfo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '下单前必须完善手机号码和姓名',
  `user_info` text COMMENT '填写选项(以json格式保存)',
  `mobilechange` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启修改手机链接 0.关闭 1.开启',
  `autogood` int(4) NOT NULL DEFAULT '0' COMMENT '超时自动好评 默认0为关闭',
  `posterbg` varchar(255) DEFAULT NULL COMMENT '推广海报背景图',
  `teacherlist` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0.不显示 1.讲师列表  2.VIP会员  3.优惠券中心',
  `category_ico` varchar(255) NOT NULL COMMENT '所有分类图标',
  `index_lazyload` text COMMENT '首页延迟加载',
  `self_diy` text COMMENT '个人中心自定义栏目',
  `stock_config` tinyint(1) DEFAULT '0' COMMENT '是否启用库存 0.否 1.是',
  `is_invoice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开具发票 0.不支持 1.支持',
  `lesson_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程详情页默认显示',
  `follow_word` varchar(100) DEFAULT NULL COMMENT '引导关注提示语',
  `audit_evaluate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程评价是否需要审核  0.否 1.是',
  `visit_limit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '非微信端访问 0.不允许 1.允许',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `login_visit` text COMMENT '需要登录访问的控制器',
  `poster_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '推广海报样式 1.直接进入微课堂  2.直接进入公众号',
  `show_newlesson` tinyint(2) NOT NULL DEFAULT '0' COMMENT '首页显示最新课程数量',
  `lesson_follow_title` varchar(255) DEFAULT NULL COMMENT '课程页强制关注标题',
  `lesson_follow_desc` varchar(255) DEFAULT NULL COMMENT '课程页强制关注描述',
  `receive_coupon` varchar(255) DEFAULT NULL COMMENT '优惠券到账通知',
  `self_setting` tinyint(1) NOT NULL DEFAULT '0' COMMENT '前端个人中心“设置”按钮',
  `sale_desc` text COMMENT '推广海报页面说明',
  `dayu_sms` text COMMENT '大于短信配置信息',
  `modify_mobile` tinyint(1) NOT NULL DEFAULT '0' COMMENT '修改手机号码',
  `poster_config` text COMMENT '海报参数设置',
  `qun_service` text COMMENT '加群客服人员',
  `index_verify` text COMMENT '首页验证绑定选项',
  `search_box` text COMMENT '首页搜索框',
  `open_https` tinyint(1) NOT NULL DEFAULT '0' COMMENT '强制https 0.否 1.是',
  `show_teacher_income` tinyint(1) NOT NULL DEFAULT '1' COMMENT '后台发布课程显示讲师分成',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='基本设置';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_son` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `parentid` int(11) NOT NULL COMMENT '课程关联id',
  `title` varchar(255) NOT NULL COMMENT '章节名称',
  `savetype` tinyint(1) NOT NULL COMMENT '存储方式 0.其他存储 1.七牛存储 2.内嵌播放代码模式',
  `sectiontype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '章节类型 1.视频章节 2.图文章节',
  `videourl` text COMMENT '章节视频url',
  `videotime` varchar(100) NOT NULL COMMENT '视频时长',
  `content` longtext COMMENT '章节内容',
  `displayorder` int(4) NOT NULL DEFAULT '0',
  `is_free` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为试听章节 0.否 1.是',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示 0.隐藏 1.显示',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `auto_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '自动上架 0.关闭 1.开启',
  `show_time` int(11) NOT NULL DEFAULT '0' COMMENT '自动上架时间',
  `test_time` int(4) NOT NULL DEFAULT '0' COMMENT '试听时间(单位:秒，0为关闭)',
  `images` varchar(255) DEFAULT NULL COMMENT '章节封面图',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_parentid` (`parentid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='课程章节';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_spec` (
  `spec_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `lessonid` int(11) NOT NULL COMMENT '课程id',
  `spec_day` int(11) DEFAULT NULL COMMENT '有效期(天)',
  `spec_price` decimal(10,2) DEFAULT '0.00' COMMENT '规格价格',
  `spec_stock` int(11) DEFAULT NULL COMMENT '库存',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`spec_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='课程规格';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_static` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `lessonOrder_num` int(11) NOT NULL DEFAULT '0' COMMENT '课程订单总量',
  `lessonOrder_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程订单总额',
  `vipOrder_num` int(11) NOT NULL DEFAULT '0' COMMENT 'vip订单总量',
  `vipOrder_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP订单总额',
  `static_time` int(11) NOT NULL COMMENT '统计日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='财务统计';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_syslog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `admin_uid` int(11) DEFAULT NULL COMMENT '管理员id',
  `admin_username` varchar(50) DEFAULT NULL COMMENT '管理员昵称',
  `log_type` tinyint(1) DEFAULT NULL COMMENT '操作类型 1.增加 2.删除 3更新',
  `function` varchar(100) DEFAULT NULL COMMENT '操作的功能',
  `content` varchar(1000) DEFAULT NULL COMMENT '操作描述',
  `ip` varchar(50) DEFAULT NULL COMMENT '操作IP地址',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_admin_uid` (`admin_uid`),
  KEY `idx_log_type` (`log_type`),
  KEY `idx_function` (`function`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='操作日志';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `account` varchar(20) DEFAULT NULL COMMENT '讲师登录帐号',
  `password` varchar(32) DEFAULT NULL COMMENT '讲师登录密码',
  `teacher` varchar(100) NOT NULL COMMENT '讲师名称',
  `qq` varchar(20) DEFAULT NULL COMMENT '讲师QQ',
  `qqgroup` varchar(20) DEFAULT NULL COMMENT '讲师QQ群',
  `qqgroupLink` varchar(255) DEFAULT NULL COMMENT 'QQ群加群链接',
  `weixin_qrcode` varchar(255) NOT NULL,
  `first_letter` varchar(10) DEFAULT NULL COMMENT '讲师名称首字母拼音',
  `teacherdes` text COMMENT '讲师介绍',
  `teacherphoto` varchar(255) DEFAULT NULL COMMENT '讲师相片',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '讲师状态 -1.审核不通过 1.正常 2.审核中',
  `upload` tinyint(1) NOT NULL DEFAULT '1' COMMENT '上传权限 0.禁止 1.允许',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `teacher_income` tinyint(2) NOT NULL DEFAULT '0' COMMENT '讲师分成(单位%)',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_account` (`account`),
  KEY `idx_status` (`status`),
  KEY `idx_upload` (`upload`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='讲师信息';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_teacher_income` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `teacher` varchar(255) DEFAULT NULL COMMENT '讲师名称',
  `ordersn` varchar(100) DEFAULT NULL COMMENT '订单编号',
  `bookname` varchar(255) DEFAULT NULL COMMENT '课程名称',
  `orderprice` decimal(10,2) DEFAULT '0.00' COMMENT '订单价格',
  `teacher_income` tinyint(3) DEFAULT NULL COMMENT '讲师分成',
  `income_amount` decimal(10,2) DEFAULT '0.00' COMMENT '讲师实际收入',
  `addtime` int(10) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_teacher` (`teacher`),
  KEY `idx_ordersn` (`ordersn`),
  KEY `idx_bookname` (`bookname`),
  KEY `idx_addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='讲师收入';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_tplmessage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `buysucc` varchar(255) DEFAULT NULL COMMENT '用户购买成功通知',
  `cnotice` varchar(255) DEFAULT NULL COMMENT '佣金提醒',
  `newjoin` varchar(255) DEFAULT NULL COMMENT '下级代理商加入提醒',
  `newlesson` varchar(255) DEFAULT NULL COMMENT '课程通知',
  `neworder` varchar(255) DEFAULT NULL COMMENT '订单通知(管理员)',
  `newcash` varchar(255) DEFAULT NULL COMMENT '提现申请通知(管理员)',
  `apply_teacher` varchar(255) DEFAULT NULL COMMENT '申请讲师入驻审核通知',
  `receive_coupon` varchar(255) DEFAULT NULL COMMENT '优惠券到账通知',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `buysucc_format` text COMMENT '购买成功模版消息格式',
  `cnotice_format` text COMMENT '佣金提醒模版消息格式',
  `newjoin_format` text COMMENT '下级代理商加入模版消息格式',
  `neworder_format` text COMMENT '订单通知(管理员)模版消息格式',
  `newcash_format` text COMMENT '提现申请通知模版消息格式',
  `apply_teacher_format` text COMMENT '讲师申请通知模版消息格式',
  `receive_coupon_format` text COMMENT '优惠券到账模版消息格式',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模版消息';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_vip_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `level_name` varchar(100) DEFAULT NULL COMMENT 'vip等级名称',
  `level_validity` int(11) DEFAULT NULL COMMENT '有效期',
  `level_price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `discount` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '购买课程折扣 0.没有折扣',
  `sort` int(4) DEFAULT '0' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示状态 0.隐藏  1.显示',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '赠送积分',
  `commission` text COMMENT '佣金比例',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_is_show` (`is_show`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='VIP等级';
CREATE TABLE IF NOT EXISTS `ims_fy_lesson_vipcard` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `card_id` varchar(50) DEFAULT NULL COMMENT '卡号',
  `password` varchar(100) DEFAULT NULL COMMENT '服务卡密码',
  `level_id` int(11) NOT NULL COMMENT 'VIP等级ID',
  `viptime` decimal(10,2) DEFAULT NULL COMMENT '服务卡时长',
  `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0.未使用 1.已使用',
  `nickname` varchar(100) DEFAULT NULL COMMENT '会员昵称',
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `ordersn` varchar(50) DEFAULT NULL COMMENT '使用订单编号(对应vip订单表的ordersn)',
  `use_time` int(10) DEFAULT NULL COMMENT '使用时间',
  `validity` int(10) DEFAULT NULL COMMENT '有效期',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_card_id` (`card_id`),
  KEY `idx_is_use` (`is_use`),
  KEY `idx_uid` (`uid`),
  KEY `idx_nickname` (`nickname`),
  KEY `idx_ordersn` (`ordersn`),
  KEY `idx_validity` (`validity`),
  KEY `idx_use_time` (`use_time`)
) ENGINE=MyISAM AUTO_INCREMENT=501 DEFAULT CHARSET=utf8 COMMENT='VIP服务卡';
";
pdo_run($sql);
if(!pdo_fieldexists("fy_lesson_article", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_article", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_article", "title")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `title` varchar(255) DEFAULT NULL COMMENT '标题';");
}
if(!pdo_fieldexists("fy_lesson_article", "author")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `author` varchar(100) DEFAULT NULL COMMENT '作者';");
}
if(!pdo_fieldexists("fy_lesson_article", "content")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `content` text COMMENT '内容';");
}
if(!pdo_fieldexists("fy_lesson_article", "linkurl")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `linkurl` varchar(1000) DEFAULT NULL COMMENT '原文链接';");
}
if(!pdo_fieldexists("fy_lesson_article", "images")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `images` varchar(255) DEFAULT NULL COMMENT '分享图片';");
}
if(!pdo_fieldexists("fy_lesson_article", "desc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `desc` text NOT NULL COMMENT '分享描述';");
}
if(!pdo_fieldexists("fy_lesson_article", "isshow")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `isshow` tinyint(1) DEFAULT '1' COMMENT '前台展示 0.关闭 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_article", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `displayorder` varchar(255) DEFAULT '0' COMMENT '排序 数值越大越靠前';");
}
if(!pdo_fieldexists("fy_lesson_article", "view")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `view` int(11) NOT NULL DEFAULT '0' COMMENT '访问量';");
}
if(!pdo_fieldexists("fy_lesson_article", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '发布时间';");
}
if(!pdo_fieldexists("fy_lesson_article", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_article", "idx_title")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   KEY `idx_title` (`title`);");
}
if(!pdo_fieldexists("fy_lesson_article", "idx_author")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   KEY `idx_author` (`author`);");
}
if(!pdo_fieldexists("fy_lesson_article", "idx_isshow")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   KEY `idx_isshow` (`isshow`);");
}
if(!pdo_fieldexists("fy_lesson_article", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_article")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_banner", "banner_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `banner_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_banner", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号编号';");
}
if(!pdo_fieldexists("fy_lesson_banner", "banner_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `banner_name` varchar(255) DEFAULT NULL COMMENT '广告位名称';");
}
if(!pdo_fieldexists("fy_lesson_banner", "picture")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `picture` varchar(255) NOT NULL COMMENT '图片路径';");
}
if(!pdo_fieldexists("fy_lesson_banner", "link")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `link` varchar(255) DEFAULT NULL COMMENT '图片链接';");
}
if(!pdo_fieldexists("fy_lesson_banner", "is_pc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `is_pc` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0.移动端 1.PC端';");
}
if(!pdo_fieldexists("fy_lesson_banner", "is_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0.不显示 1.显示';");
}
if(!pdo_fieldexists("fy_lesson_banner", "banner_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `banner_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '图片类型 0.首页轮播图 1.底部课程广告';");
}
if(!pdo_fieldexists("fy_lesson_banner", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_banner", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `update_time` int(11) NOT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_banner", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_banner")." ADD   `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists("fy_lesson_blacklist", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_blacklist")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_blacklist", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_blacklist")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_blacklist", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_blacklist")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员编号';");
}
if(!pdo_fieldexists("fy_lesson_blacklist", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_blacklist")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_blacklist", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_blacklist")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_blacklist", "idx_openid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_blacklist")." ADD   KEY `idx_openid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_blacklist", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_blacklist")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "cash_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `cash_type` tinyint(1) NOT NULL COMMENT '提现方式 1.管理员审核 2.自动到账';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "cash_way")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `cash_way` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1.提现到余额  2.提现到微信钱包 3.提现到支付宝';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "pay_account")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `pay_account` varchar(50) DEFAULT NULL COMMENT '提现帐号';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `openid` varchar(255) NOT NULL COMMENT '粉丝编号';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "cash_num")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `cash_num` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '提现金额';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0.待审核 1.提现成功 -1.审核未通过';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "disposetime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `disposetime` int(10) NOT NULL DEFAULT '0' COMMENT '处理时间';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "partner_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `partner_trade_no` varchar(255) DEFAULT NULL COMMENT '商户订单号';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "payment_no")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `payment_no` varchar(255) DEFAULT NULL COMMENT '微信订单号';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "remark")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `remark` text COMMENT '管理员备注';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "lesson_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `lesson_type` tinyint(1) NOT NULL COMMENT '提现类型 1.分销佣金提现 2.课程收入提现';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   `addtime` int(10) NOT NULL COMMENT '申请时间';");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_cash_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_cash_type` (`cash_type`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_cash_way")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_cash_way` (`cash_way`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_openid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_openid` (`openid`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_lesson_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_lesson_type` (`lesson_type`);");
}
if(!pdo_fieldexists("fy_lesson_cashlog", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_cashlog")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_category", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_category", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists("fy_lesson_category", "name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `name` varchar(50) NOT NULL COMMENT '分类名称';");
}
if(!pdo_fieldexists("fy_lesson_category", "parentid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID;");
}
if(!pdo_fieldexists("fy_lesson_category", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD 0为第一级';");
}
if(!pdo_fieldexists("fy_lesson_category", "ico")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `ico` varchar(255) DEFAULT NULL COMMENT '分类图标';");
}
if(!pdo_fieldexists("fy_lesson_category", "link")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `link` varchar(1000) DEFAULT NULL COMMENT '自定义链接';");
}
if(!pdo_fieldexists("fy_lesson_category", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists("fy_lesson_category", "is_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示在首页(仅对一级分类生效)';");
}
if(!pdo_fieldexists("fy_lesson_category", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_category")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_code", "code_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_code")." ADD   `code_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_code", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_code")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_code", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_code")." ADD   `mobile` varchar(20) NOT NULL COMMENT '手机号码';");
}
if(!pdo_fieldexists("fy_lesson_code", "code")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_code")." ADD   `code` varchar(10) NOT NULL COMMENT '验证码';");
}
if(!pdo_fieldexists("fy_lesson_code", "is_use")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_code")." ADD   `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否使用 0.未使用 1.已使用';");
}
if(!pdo_fieldexists("fy_lesson_code", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_code")." ADD   `update_time` int(11) NOT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_collect", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_collect", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_collect", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   `uid` int(11) NOT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_collect", "outid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   `outid` int(11) NOT NULL COMMENT '外部编号(课程编号或讲师编号)';");
}
if(!pdo_fieldexists("fy_lesson_collect", "ctype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   `ctype` tinyint(1) NOT NULL COMMENT '收藏类型 1.课程 2.讲师';");
}
if(!pdo_fieldexists("fy_lesson_collect", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   `addtime` int(10) NOT NULL COMMENT '收藏时间';");
}
if(!pdo_fieldexists("fy_lesson_collect", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_collect", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_collect", "idx_ctype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   KEY `idx_ctype` (`ctype`);");
}
if(!pdo_fieldexists("fy_lesson_collect", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_collect")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "levelname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   `levelname` varchar(50) DEFAULT NULL COMMENT '分销等级名称';");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "commission1")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   `commission1` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD 2) DEFAULT '0.00' COMMENT '一级分销佣金比例';");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "commission2")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   `commission2` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD 2) DEFAULT '0.00' COMMENT '二级分销佣金比例';");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "commission3")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   `commission3` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD 2) DEFAULT '0.00' COMMENT '三级分销佣金比例';");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "updatemoney")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   `updatemoney` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD 2) DEFAULT '0.00' COMMENT '升级条件(分销佣金满多少)';");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_commission_level", "idx_levelname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_level")." ADD   KEY `idx_levelname` (`levelname`);");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "orderid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `orderid` varchar(255) DEFAULT NULL COMMENT '订单id';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `nickname` varchar(100) DEFAULT NULL COMMENT '会员昵称';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `bookname` varchar(255) DEFAULT NULL COMMENT '课程名称';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "change_num")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `change_num` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD 2) DEFAULT '0.00' COMMENT '变动数目';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "grade")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `grade` tinyint(1) DEFAULT NULL COMMENT '佣金等级';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "remark")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `remark` varchar(255) DEFAULT NULL COMMENT '变动说明';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '变动时间';");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "idx_orderid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   KEY `idx_orderid` (`orderid`);");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "idx_nickname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   KEY `idx_nickname` (`nickname`);");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "idx_bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   KEY `idx_bookname` (`bookname`);");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "idx_grade")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   KEY `idx_grade` (`grade`);");
}
if(!pdo_fieldexists("fy_lesson_commission_log", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_log")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "vip_sale")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `vip_sale` tinyint(1) DEFAULT '0' COMMENT 'VIP订单分销开关';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "vipdesc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `vipdesc` text COMMENT 'vip服务描述';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "sharelink")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `sharelink` text COMMENT '链接分享';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "sharelesson")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `sharelesson` text COMMENT '分享课程';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "shareteacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `shareteacher` text COMMENT '分享讲师';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "is_sale")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `is_sale` tinyint(1) DEFAULT '0' COMMENT '分销功能 0.关闭 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "self_sale")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `self_sale` tinyint(1) DEFAULT '0' COMMENT '分销内购 0.关闭 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "sale_rank")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `sale_rank` tinyint(1) DEFAULT '1' COMMENT '分销身份 1.任何人 2.VIP身份';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "commission")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `commission` text COMMENT '默认课程佣金比例';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "level")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `level` tinyint(1) DEFAULT '3' COMMENT '分销等级';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "cash_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `cash_type` tinyint(1) DEFAULT '1' COMMENT '提现处理方式 1.管理员审核 2.自动到账';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "cash_way")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `cash_way` text COMMENT '提现方式';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "cash_lower_vip")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `cash_lower_vip` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD 2) DEFAULT '1.00' COMMENT 'VIP提现最低额度 0.关闭';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "mchid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `mchid` varchar(50) DEFAULT NULL COMMENT '微信支付商户号';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "mchkey")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `mchkey` varchar(50) DEFAULT NULL COMMENT '微信支付商户支付密钥';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "serverIp")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `serverIp` varchar(20) DEFAULT NULL COMMENT '服务器Ip';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "agent_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `agent_status` tinyint(1) DEFAULT '1' COMMENT '分销商状态 0.关闭 1.开启 2.冻结';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "agent_condition")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `agent_condition` text COMMENT '分销商条件 1.消费金额满x元  2.消费订单满x笔  3.注册满x天';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "sale_desc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `sale_desc` text COMMENT '推广海报页面说明';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "rec_income")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `rec_income` text COMMENT '直接推荐奖励';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `addtime` int(11) DEFAULT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "cash_lower_common")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `cash_lower_common` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD 2) NOT NULL DEFAULT '1.00' COMMENT '普通用户最低提现额度 0.为关闭';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "cash_lower_teacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `cash_lower_teacher` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD 2) NOT NULL DEFAULT '1.00' COMMENT '讲师最低提现额度 0.关闭';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "qrcode_cache")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `qrcode_cache` tinyint(1) NOT NULL DEFAULT '1' COMMENT '会员海报缓存 0.不缓存  1.缓存';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "upgrade_condition")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `upgrade_condition` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分销升级条件 1.累计佣金 2.支付订单额 3.支付订单笔数';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "font")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `font` text COMMENT '分享文字(以json格式保存)';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "hidden_sale")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   `hidden_sale` tinyint(1) NOT NULL DEFAULT '0' COMMENT '隐藏前台分销按钮 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_commission_setting", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_commission_setting")." ADD   KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_coupon", "card_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `card_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_coupon", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fy_lesson_coupon", "password")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `password` varchar(18) NOT NULL COMMENT '优惠码密钥';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_coupon", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '优惠码面值';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `validity` int(10) NOT NULL COMMENT '有效期';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "conditions")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `conditions` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_coupon", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '使用条件(满x元可用)';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "is_use")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0.未使用 1.已使用';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `nickname` varchar(50) DEFAULT NULL COMMENT '昵称';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员编号';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `ordersn` varchar(50) DEFAULT NULL COMMENT '订单编号';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "use_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `use_time` int(10) DEFAULT NULL COMMENT '使用时间';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   `addtime` int(10) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_coupon", "idx_ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   UNIQUE KEY `idx_ordersn` (`ordersn`);");
}
if(!pdo_fieldexists("fy_lesson_coupon", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_coupon", "idx_password")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   KEY `idx_password` (`password`);");
}
if(!pdo_fieldexists("fy_lesson_coupon", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_coupon", "idx_validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   KEY `idx_validity` (`validity`);");
}
if(!pdo_fieldexists("fy_lesson_coupon", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_coupon")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_discount", "discount_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `discount_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_discount", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `uniacid` int(11) unsigned DEFAULT NULL COMMENT '公众号编号';");
}
if(!pdo_fieldexists("fy_lesson_discount", "title")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `title` varchar(255) DEFAULT NULL COMMENT '活动标题';");
}
if(!pdo_fieldexists("fy_lesson_discount", "content")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `content` text COMMENT '活动描述内容';");
}
if(!pdo_fieldexists("fy_lesson_discount", "member_discount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `member_discount` tinyint(1) NOT NULL DEFAULT '0' COMMENT '同时享受会员折扣 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_discount", "starttime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `starttime` int(11) DEFAULT NULL COMMENT '开始时间';");
}
if(!pdo_fieldexists("fy_lesson_discount", "endtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `endtime` int(11) DEFAULT NULL COMMENT '结束时间';");
}
if(!pdo_fieldexists("fy_lesson_discount", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists("fy_lesson_discount", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `addtime` int(11) NOT NULL COMMENT '创建时间';");
}
if(!pdo_fieldexists("fy_lesson_discount", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount")." ADD   `update_time` int(11) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "discount_lesson_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `discount_lesson_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号编号';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "discount_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `discount_id` int(11) DEFAULT NULL COMMENT '折扣活动编号';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "lesson_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `lesson_id` int(11) DEFAULT NULL COMMENT '课程编号';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "discount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `discount` int(4) DEFAULT '0' COMMENT '课程折扣 单位%';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "member_discount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `member_discount` tinyint(1) DEFAULT '0' COMMENT '同时享受会员折扣 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "starttime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `starttime` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "endtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `endtime` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间';");
}
if(!pdo_fieldexists("fy_lesson_discount_lesson", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_discount_lesson")." ADD   `addtime` int(11) NOT NULL COMMENT '创建时间';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "orderid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `orderid` int(11) unsigned NOT NULL COMMENT '订单id';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `ordersn` varchar(255) NOT NULL COMMENT '订单编号';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "lessonid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `lessonid` int(11) NOT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `bookname` varchar(255) NOT NULL COMMENT '课程名称';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "teacherid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `teacherid` int(11) DEFAULT NULL COMMENT '讲师id(与haoshu_teacher表的id字段对应)';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `uid` int(11) NOT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `nickname` varchar(50) NOT NULL COMMENT '会员昵称';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "grade")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `grade` tinyint(1) NOT NULL COMMENT '评价 1.好评 2.中评 3.差评';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "content")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `content` text NOT NULL COMMENT '评价内容';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "reply")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `reply` text COMMENT '评价回复';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论状态 -1.审核未通过 0.待审核 1.审核通过';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   `addtime` int(10) NOT NULL COMMENT '评价时间';");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "idx_orderid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   KEY `idx_orderid` (`orderid`);");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "idx_ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   KEY `idx_ordersn` (`ordersn`);");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "idx_lessonid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   KEY `idx_lessonid` (`lessonid`);");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "idx_bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   KEY `idx_bookname` (`bookname`);");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "idx_teacherid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   KEY `idx_teacherid` (`teacherid`);");
}
if(!pdo_fieldexists("fy_lesson_evaluate", "idx_grade")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_evaluate")." ADD   KEY `idx_grade` (`grade`);");
}
if(!pdo_fieldexists("fy_lesson_history", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_history", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_history", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   `uid` int(11) NOT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_history", "lessonid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   `lessonid` int(11) NOT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists("fy_lesson_history", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   `addtime` int(10) NOT NULL COMMENT '最后进入时间';");
}
if(!pdo_fieldexists("fy_lesson_history", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_history", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_history", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_history")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_inform", "inform_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `inform_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_inform", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_inform", "lesson_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `lesson_id` int(11) DEFAULT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists("fy_lesson_inform", "book_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `book_name` varchar(255) DEFAULT NULL COMMENT '课程名称';");
}
if(!pdo_fieldexists("fy_lesson_inform", "content")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `content` text COMMENT '模版消息内容(json格式保存)';");
}
if(!pdo_fieldexists("fy_lesson_inform", "user_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `user_type` tinyint(1) DEFAULT NULL COMMENT '用户类型 1.全部会员 2.VIP会员 3.购买过该讲师的会员';");
}
if(!pdo_fieldexists("fy_lesson_inform", "inform_number")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `inform_number` int(11) DEFAULT NULL COMMENT '发送总量';");
}
if(!pdo_fieldexists("fy_lesson_inform", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `status` tinyint(1) DEFAULT '1' COMMENT '状态 1.发送中 0.发送完毕';");
}
if(!pdo_fieldexists("fy_lesson_inform", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_inform", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   `update_time` int(11) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_inform", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_inform", "lesson_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform")." ADD   KEY `lesson_id` (`lesson_id`);");
}
if(!pdo_fieldexists("fy_lesson_inform_fans", "inform_fans_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform_fans")." ADD   `inform_fans_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_inform_fans", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform_fans")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_inform_fans", "inform_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform_fans")." ADD   `inform_id` int(11) DEFAULT NULL COMMENT '通知id';");
}
if(!pdo_fieldexists("fy_lesson_inform_fans", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform_fans")." ADD   `openid` varchar(50) DEFAULT NULL COMMENT '粉丝编号';");
}
if(!pdo_fieldexists("fy_lesson_inform_fans", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform_fans")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_inform_fans", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform_fans")." ADD   KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_inform_fans", "inform_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_inform_fans")." ADD   KEY `inform_id` (`inform_id`);");
}
if(!pdo_fieldexists("fy_lesson_market", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_market", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists("fy_lesson_market", "deduct_switch")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `deduct_switch` tinyint(1) DEFAULT '0' COMMENT '积分抵扣开关';");
}
if(!pdo_fieldexists("fy_lesson_market", "deduct_money")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `deduct_money` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_market", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD 2) DEFAULT '0.00' COMMENT '1积分抵扣金额';");
}
if(!pdo_fieldexists("fy_lesson_market", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_market", "reg_give")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `reg_give` text COMMENT '注册赠送优惠券';");
}
if(!pdo_fieldexists("fy_lesson_market", "recommend")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `recommend` text COMMENT '推荐下级赠送优惠券';");
}
if(!pdo_fieldexists("fy_lesson_market", "recommend_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `recommend_time` int(11) NOT NULL DEFAULT '0' COMMENT '最多可获取次数 0.不限制';");
}
if(!pdo_fieldexists("fy_lesson_market", "buy_lesson")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `buy_lesson` text COMMENT '购买课程赠送优惠券';");
}
if(!pdo_fieldexists("fy_lesson_market", "buy_lesson_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `buy_lesson_time` int(11) NOT NULL DEFAULT '0' COMMENT '最多可获取次数 0.不限制';");
}
if(!pdo_fieldexists("fy_lesson_market", "share_lesson")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `share_lesson` text COMMENT '分享课程赠送优惠券';");
}
if(!pdo_fieldexists("fy_lesson_market", "share_lesson_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `share_lesson_time` int(11) NOT NULL DEFAULT '0' COMMENT '最多可获取次数 0.不限制';");
}
if(!pdo_fieldexists("fy_lesson_market", "coupon_desc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   `coupon_desc` text COMMENT '优惠券页面说明';");
}
if(!pdo_fieldexists("fy_lesson_market", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_market")." ADD   KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `name` varchar(255) NOT NULL COMMENT '名称';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD 2) DEFAULT '0.00' COMMENT '优惠券面值';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "images")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `images` varchar(255) NOT NULL COMMENT ' 优惠券封面图';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "validity_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `validity_type` text COMMENT '有效期 1.固定有效期 2.自增有效期';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "days1")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `days1` int(11) NOT NULL COMMENT '固定有效期';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "days2")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `days2` int(11) NOT NULL COMMENT '自增有效期(天)';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "conditions")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `conditions` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD 2) DEFAULT '0.00' COMMENT '使用条件 满x元可使用';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "is_exchange")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `is_exchange` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支持积分兑换 0.不支持 1.支持';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "exchange_integral")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `exchange_integral` int(11) NOT NULL COMMENT '每张优惠券兑换积分';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "max_exchange")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `max_exchange` int(11) NOT NULL COMMENT '每位用户最大兑换数量';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "total_exchange")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `total_exchange` int(11) NOT NULL COMMENT '总共优惠券张数';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "already_exchange")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `already_exchange` int(11) NOT NULL COMMENT '已兑换数量';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "category_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `category_id` int(11) DEFAULT NULL COMMENT '使用条件 指定分类课程使用 0.为全部课程';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `status` tinyint(1) DEFAULT '0' COMMENT '状态 0.下架 1.上架';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `update_time` int(11) NOT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "receive_link")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   `receive_link` tinyint(1) NOT NULL DEFAULT '0' COMMENT '链接领取 0.不支持 1.支持';");
}
if(!pdo_fieldexists("fy_lesson_mcoupon", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_mcoupon")." ADD   KEY `status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_member", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_member", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_member", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `uid` int(11) NOT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_member", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `nickname` varchar(100) DEFAULT NULL COMMENT '昵称';");
}
if(!pdo_fieldexists("fy_lesson_member", "studentno")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `studentno` varchar(20) DEFAULT NULL COMMENT '会员号';");
}
if(!pdo_fieldexists("fy_lesson_member", "gohome")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `gohome` tinyint(1) NOT NULL DEFAULT '0' COMMENT '学员是否进群 0.未进群 1.已进群';");
}
if(!pdo_fieldexists("fy_lesson_member", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '粉丝标识';");
}
if(!pdo_fieldexists("fy_lesson_member", "parentid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `parentid` int(11) DEFAULT NULL COMMENT '推荐人id';");
}
if(!pdo_fieldexists("fy_lesson_member", "leaderunion")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `leaderunion` tinyint(1) NOT NULL DEFAULT '0' COMMENT '联合发起人身份 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_member", "nopay_commission")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `nopay_commission` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '未结算佣金';");
}
if(!pdo_fieldexists("fy_lesson_member", "pay_commission")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `pay_commission` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '已结算佣金';");
}
if(!pdo_fieldexists("fy_lesson_member", "nopay_lesson")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `nopay_lesson` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '未提现课程收入';");
}
if(!pdo_fieldexists("fy_lesson_member", "pay_lesson")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `pay_lesson` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '已提现课程收入';");
}
if(!pdo_fieldexists("fy_lesson_member", "vip")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `vip` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否vip 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_member", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `validity` bigint(11) NOT NULL DEFAULT '0' COMMENT 'vip有效期';");
}
if(!pdo_fieldexists("fy_lesson_member", "pastnotice")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `pastnotice` int(10) NOT NULL DEFAULT '0' COMMENT 'vip服务过期前最新通知时间';");
}
if(!pdo_fieldexists("fy_lesson_member", "agent_level")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `agent_level` int(11) NOT NULL DEFAULT '0' COMMENT '分销代理级别';");
}
if(!pdo_fieldexists("fy_lesson_member", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分销状态 0.冻结 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_member", "uptime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `uptime` int(10) NOT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_member", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_member", "payment_amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `payment_amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '购买订单总额';");
}
if(!pdo_fieldexists("fy_lesson_member", "payment_order")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   `payment_order` int(11) NOT NULL DEFAULT '0' COMMENT '购买订单笔数';");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_openid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_openid` (`openid`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_parentid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_parentid` (`parentid`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_vip")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_vip` (`vip`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_validity` (`validity`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_pastnotice")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_pastnotice` (`pastnotice`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_member", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD 2) DEFAULT '0.00' COMMENT '优惠券面值';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "conditions")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `conditions` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD 2) DEFAULT '0.00' COMMENT '使用条件';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `validity` int(11) DEFAULT NULL COMMENT '有效期';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "category_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `category_id` int(11) NOT NULL COMMENT '指定分类课程可用';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "password")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `password` varchar(100) DEFAULT NULL COMMENT '优惠券密码(优惠码转换过来的)';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `ordersn` varchar(100) DEFAULT NULL COMMENT '使用订单号';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `status` tinyint(4) DEFAULT NULL COMMENT '状态 -1.已过期 0.未使用 1.已使用';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "source")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `source` tinyint(1) NOT NULL COMMENT '来源 1.优惠码转换 2.购买课程赠送 3.邀请下级成员赠送 4.分享课程赠送 5.积分兑换';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "coupon_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `coupon_id` int(11) DEFAULT NULL COMMENT '优惠券id(兑换)';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   `update_time` int(11) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   KEY `uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   KEY `validity` (`validity`);");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   KEY `status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "source")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   KEY `source` (`source`);");
}
if(!pdo_fieldexists("fy_lesson_member_coupon", "category_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_coupon")." ADD   KEY `category_id` (`category_id`);");
}
if(!pdo_fieldexists("fy_lesson_member_order", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_member_order", "acid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `acid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `ordersn` varchar(255) NOT NULL COMMENT '订单编号';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `uid` int(11) NOT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "level_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `level_id` int(11) NOT NULL COMMENT 'vip会员等级id(与fy_lesson_vip_level表id对应)';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "level_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `level_name` varchar(255) DEFAULT NULL COMMENT 'VIP等级名称';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "viptime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `viptime` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD 2) DEFAULT NULL COMMENT '会员服务时间';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "vipmoney")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `vipmoney` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD 2) NOT NULL COMMENT '会员服务价格';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "paytype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `paytype` varchar(50) NOT NULL COMMENT '支付方式';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态 0.未支付 1.已支付';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "paytime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `paytime` int(10) DEFAULT '0' COMMENT '订单支付时间';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "member1")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `member1` int(11) NOT NULL COMMENT '一级代理会员id';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "commission1")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `commission1` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD 2) NOT NULL COMMENT '一级代理佣金';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "member2")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `member2` int(11) NOT NULL COMMENT '二级代理会员id';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "commission2")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `commission2` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD 2) NOT NULL COMMENT '二级代理佣金';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "member3")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `member3` int(11) NOT NULL COMMENT '三级代理会员id';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "commission3")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `commission3` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_member_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD 2) NOT NULL COMMENT '三级代理佣金';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "refer_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `refer_id` int(11) DEFAULT NULL COMMENT '充值卡id(与vip卡的id对应)';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `addtime` int(10) NOT NULL COMMENT '订单添加时间';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `update_time` int(10) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "integral")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   `integral` int(11) NOT NULL DEFAULT '0' COMMENT '赠送积分';");
}
if(!pdo_fieldexists("fy_lesson_member_order", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_member_order", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_member_order", "idx_paytype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   KEY `idx_paytype` (`paytype`);");
}
if(!pdo_fieldexists("fy_lesson_member_order", "idx_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_member_order", "idx_refer_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   KEY `idx_refer_id` (`refer_id`);");
}
if(!pdo_fieldexists("fy_lesson_member_order", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_order")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_member_recommend", "recommend_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_recommend")." ADD   `recommend_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_member_recommend", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_recommend")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号编号';");
}
if(!pdo_fieldexists("fy_lesson_member_recommend", "unionid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_recommend")." ADD   `unionid` varchar(255) NOT NULL COMMENT '会员unionid';");
}
if(!pdo_fieldexists("fy_lesson_member_recommend", "parentid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_recommend")." ADD   `parentid` int(11) NOT NULL COMMENT '推荐人编号';");
}
if(!pdo_fieldexists("fy_lesson_member_recommend", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_recommend")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `uid` int(11) NOT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "level_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `level_id` int(11) DEFAULT NULL COMMENT 'vip等级id';");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `validity` int(11) DEFAULT NULL COMMENT '有效期';");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "discount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `discount` int(4) DEFAULT '100' COMMENT '折扣';");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_member_vip", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_member_vip")." ADD   `update_time` int(11) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_order", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_order", "acid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `acid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fy_lesson_order", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_order", "ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `ordersn` varchar(255) NOT NULL COMMENT '订单编号';");
}
if(!pdo_fieldexists("fy_lesson_order", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `uid` int(11) NOT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_order", "lessonid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `lessonid` int(11) NOT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists("fy_lesson_order", "bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `bookname` varchar(255) NOT NULL COMMENT '课程名称';");
}
if(!pdo_fieldexists("fy_lesson_order", "marketprice")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `marketprice` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '原价';");
}
if(!pdo_fieldexists("fy_lesson_order", "coupon")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `coupon` varchar(50) DEFAULT NULL COMMENT '课程优惠码';");
}
if(!pdo_fieldexists("fy_lesson_order", "coupon_amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `coupon_amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '优惠码面值';");
}
if(!pdo_fieldexists("fy_lesson_order", "price")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `price` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '课程价格';");
}
if(!pdo_fieldexists("fy_lesson_order", "spec_day")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `spec_day` int(4) DEFAULT NULL COMMENT '课程规格(多少天内有效)';");
}
if(!pdo_fieldexists("fy_lesson_order", "teacherid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `teacherid` int(11) DEFAULT NULL COMMENT '讲师id(与haoshu_teacher表的id字段对应)';");
}
if(!pdo_fieldexists("fy_lesson_order", "teacher_income")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `teacher_income` tinyint(3) NOT NULL DEFAULT '0' COMMENT '讲师收入(课程价格分成%)';");
}
if(!pdo_fieldexists("fy_lesson_order", "integral")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `integral` int(4) NOT NULL DEFAULT '0' COMMENT '赠送积分';");
}
if(!pdo_fieldexists("fy_lesson_order", "deduct_integral")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `deduct_integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分抵扣数量';");
}
if(!pdo_fieldexists("fy_lesson_order", "invoice")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `invoice` varchar(100) DEFAULT NULL COMMENT '发票';");
}
if(!pdo_fieldexists("fy_lesson_order", "paytype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `paytype` varchar(50) NOT NULL DEFAULT '0' COMMENT '支付方式';");
}
if(!pdo_fieldexists("fy_lesson_order", "paytime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `paytime` int(10) NOT NULL DEFAULT '0' COMMENT '支付时间';");
}
if(!pdo_fieldexists("fy_lesson_order", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `validity` int(11) NOT NULL DEFAULT '0' COMMENT '有效期 在有效期内可观看学习课程';");
}
if(!pdo_fieldexists("fy_lesson_order", "member1")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `member1` int(11) NOT NULL DEFAULT '0' COMMENT '一级代理会员id';");
}
if(!pdo_fieldexists("fy_lesson_order", "commission1")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `commission1` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '一级佣金';");
}
if(!pdo_fieldexists("fy_lesson_order", "member2")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `member2` int(11) NOT NULL DEFAULT '0' COMMENT '二级代理会员id';");
}
if(!pdo_fieldexists("fy_lesson_order", "commission2")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `commission2` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '二级佣金';");
}
if(!pdo_fieldexists("fy_lesson_order", "member3")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `member3` int(11) NOT NULL DEFAULT '0' COMMENT '三级代理会员id';");
}
if(!pdo_fieldexists("fy_lesson_order", "commission3")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `commission3` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_order", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '三级佣金';");
}
if(!pdo_fieldexists("fy_lesson_order", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态 -1.已取消 0.未支付 1.已支付 2.已评价';");
}
if(!pdo_fieldexists("fy_lesson_order", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '下单时间';");
}
if(!pdo_fieldexists("fy_lesson_order", "lesson_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `lesson_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程类型 0.普通课程  1.预约课程';");
}
if(!pdo_fieldexists("fy_lesson_order", "appoint_info")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `appoint_info` text COMMENT '预约信息(json格式保存)';");
}
if(!pdo_fieldexists("fy_lesson_order", "is_delete")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除';");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_acid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_acid` (`acid`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_ordersn` (`ordersn`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_lessonid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_lessonid` (`lessonid`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_bookname` (`bookname`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_teacherid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_teacherid` (`teacherid`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_paytype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_paytype` (`paytype`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_order", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "order_detail_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `order_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "order_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `order_id` int(11) DEFAULT NULL COMMENT '订单id';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "real_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `real_name` varchar(50) DEFAULT NULL COMMENT '姓名';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `mobile` varchar(50) DEFAULT NULL COMMENT '手机号码';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "receive_date")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `receive_date` date DEFAULT NULL COMMENT '指定日期';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "receive_address")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `receive_address` varchar(255) DEFAULT NULL COMMENT '地址';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "remark")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `remark` text COMMENT '备注';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   `update_time` int(11) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_order_detail", "order_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_order_detail")." ADD   KEY `order_id` (`order_id`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_parent", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists("fy_lesson_parent", "pid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `pid` int(11) DEFAULT NULL COMMENT '父分类id';");
}
if(!pdo_fieldexists("fy_lesson_parent", "cid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `cid` int(11) NOT NULL COMMENT '分类ID';");
}
if(!pdo_fieldexists("fy_lesson_parent", "bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `bookname` varchar(255) NOT NULL COMMENT '课程名称';");
}
if(!pdo_fieldexists("fy_lesson_parent", "price")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `price` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_parent", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '课程价格';");
}
if(!pdo_fieldexists("fy_lesson_parent", "isdiscount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `isdiscount` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启该课程折扣';");
}
if(!pdo_fieldexists("fy_lesson_parent", "vipdiscount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `vipdiscount` int(3) NOT NULL DEFAULT '0' COMMENT 'vip会员折扣';");
}
if(!pdo_fieldexists("fy_lesson_parent", "integral")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `integral` int(11) NOT NULL DEFAULT '0' COMMENT '购买赠送积分';");
}
if(!pdo_fieldexists("fy_lesson_parent", "deduct_integral")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `deduct_integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分最多抵扣数量';");
}
if(!pdo_fieldexists("fy_lesson_parent", "images")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `images` varchar(255) DEFAULT NULL COMMENT '课程封图';");
}
if(!pdo_fieldexists("fy_lesson_parent", "poster")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `poster` text COMMENT '视频播放封面图';");
}
if(!pdo_fieldexists("fy_lesson_parent", "descript")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `descript` longtext COMMENT '课程介绍';");
}
if(!pdo_fieldexists("fy_lesson_parent", "difficulty")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `difficulty` varchar(100) DEFAULT NULL COMMENT '课程难度';");
}
if(!pdo_fieldexists("fy_lesson_parent", "stock")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `stock` int(11) NOT NULL COMMENT '库存';");
}
if(!pdo_fieldexists("fy_lesson_parent", "buynum")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `buynum` int(11) NOT NULL DEFAULT '0' COMMENT '正常购买人数';");
}
if(!pdo_fieldexists("fy_lesson_parent", "virtual_buynum")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `virtual_buynum` int(11) NOT NULL DEFAULT '0' COMMENT '虚拟购买人数';");
}
if(!pdo_fieldexists("fy_lesson_parent", "score")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `score` decimal(5;");
}
if(!pdo_fieldexists("fy_lesson_parent", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD 2) NOT NULL COMMENT '课程好评率';");
}
if(!pdo_fieldexists("fy_lesson_parent", "teacherid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `teacherid` int(11) NOT NULL COMMENT '主讲老师id';");
}
if(!pdo_fieldexists("fy_lesson_parent", "commission")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `commission` text COMMENT '佣金比例';");
}
if(!pdo_fieldexists("fy_lesson_parent", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '课程排序';");
}
if(!pdo_fieldexists("fy_lesson_parent", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `status` tinyint(1) NOT NULL COMMENT '课程状态 -1.暂停销售 0.下架 1.上架 2.审核中';");
}
if(!pdo_fieldexists("fy_lesson_parent", "recommendid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `recommendid` varchar(255) DEFAULT NULL COMMENT '推荐板块id';");
}
if(!pdo_fieldexists("fy_lesson_parent", "vipview")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `vipview` varchar(100) DEFAULT NULL COMMENT '免费学习的VIP等级集合';");
}
if(!pdo_fieldexists("fy_lesson_parent", "teacher_income")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `teacher_income` tinyint(3) NOT NULL DEFAULT '0' COMMENT '讲师分成%';");
}
if(!pdo_fieldexists("fy_lesson_parent", "link")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `link` varchar(1000) DEFAULT NULL COMMENT '自定义链接';");
}
if(!pdo_fieldexists("fy_lesson_parent", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `validity` int(11) NOT NULL DEFAULT '0' COMMENT '有效期 即购买时起多少天内有效';");
}
if(!pdo_fieldexists("fy_lesson_parent", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `addtime` int(10) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_parent", "share")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `share` text COMMENT '分享信息';");
}
if(!pdo_fieldexists("fy_lesson_parent", "support_coupon")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `support_coupon` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否支持优惠券抵扣 0.不支持 1.支持';");
}
if(!pdo_fieldexists("fy_lesson_parent", "integral_rate")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `integral_rate` decimal(5;");
}
if(!pdo_fieldexists("fy_lesson_parent", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD 2) DEFAULT '0.00' COMMENT '赠送积分比例';");
}
if(!pdo_fieldexists("fy_lesson_parent", "visit_number")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `visit_number` int(11) NOT NULL DEFAULT '0' COMMENT '访问人数';");
}
if(!pdo_fieldexists("fy_lesson_parent", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `update_time` int(11) DEFAULT NULL COMMENT '章节最后更新时间';");
}
if(!pdo_fieldexists("fy_lesson_parent", "ico_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `ico_name` varchar(100) DEFAULT NULL COMMENT '课程标识';");
}
if(!pdo_fieldexists("fy_lesson_parent", "lesson_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `lesson_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程类型 0.普通课程  1.预约课程';");
}
if(!pdo_fieldexists("fy_lesson_parent", "appoint_info")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `appoint_info` text COMMENT '预约信息(json格式保存)';");
}
if(!pdo_fieldexists("fy_lesson_parent", "section_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   `section_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '连载状态 0.更新中 1.已完结';");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_cid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_cid` (`cid`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_bookname` (`bookname`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_teacherid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_teacherid` (`teacherid`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_recommendid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_recommendid` (`recommendid`);");
}
if(!pdo_fieldexists("fy_lesson_parent", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_parent")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "lessonid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   `lessonid` int(11) DEFAULT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "sectionid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   `sectionid` int(11) DEFAULT NULL COMMENT '章节id';");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "playtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   `playtime` int(11) NOT NULL DEFAULT '0' COMMENT '上次播放时间 单位：秒';");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_playrecord", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_playrecord")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "teacherid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `teacherid` int(11) DEFAULT NULL COMMENT '讲师id(讲师id为空表示后台上传)';");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `name` varchar(500) DEFAULT NULL COMMENT '文件名称';");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "com_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `com_name` varchar(1000) DEFAULT NULL COMMENT '完整文件名';");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "sys_link")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `sys_link` varchar(1000) DEFAULT NULL COMMENT '原始链接';");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "size")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `size` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD 2) DEFAULT NULL COMMENT '视频大小';");
}
if(!pdo_fieldexists("fy_lesson_qcloud_upload", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qcloud_upload")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员编号';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '粉丝编号';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "teacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `teacher` int(11) DEFAULT NULL COMMENT '讲师编号';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `name` varchar(500) DEFAULT NULL COMMENT '文件名';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "com_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `com_name` varchar(1000) DEFAULT NULL COMMENT '完成文件名';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "qiniu_url")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `qiniu_url` varchar(1000) DEFAULT NULL COMMENT '文件链接';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "size")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `size` varchar(100) DEFAULT NULL COMMENT '文件大小';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "idx_teacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   KEY `idx_teacher` (`teacher`);");
}
if(!pdo_fieldexists("fy_lesson_qiniu_upload", "idx_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_qiniu_upload")." ADD   KEY `idx_name` (`name`(333));");
}
if(!pdo_fieldexists("fy_lesson_recommend", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_recommend", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_recommend", "rec_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `rec_name` varchar(255) DEFAULT NULL COMMENT '模块名称';");
}
if(!pdo_fieldexists("fy_lesson_recommend", "show_style")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `show_style` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示样式 1.单课程模式 2.课程+专题模式 3.专题模式';");
}
if(!pdo_fieldexists("fy_lesson_recommend", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `displayorder` int(4) DEFAULT NULL COMMENT '排序';");
}
if(!pdo_fieldexists("fy_lesson_recommend", "is_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示';");
}
if(!pdo_fieldexists("fy_lesson_recommend", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `addtime` int(10) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_recommend", "limit_number")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   `limit_number` int(4) NOT NULL DEFAULT '6' COMMENT '首页显示数量';");
}
if(!pdo_fieldexists("fy_lesson_recommend", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_recommend", "idx_is_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_recommend")." ADD   KEY `idx_is_show` (`is_show`);");
}
if(!pdo_fieldexists("fy_lesson_setting", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_setting", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_setting", "logo")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `logo` varchar(255) NOT NULL COMMENT 'app端logo';");
}
if(!pdo_fieldexists("fy_lesson_setting", "manageopenid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `manageopenid` text NOT NULL COMMENT '新订单提醒(管理员)';");
}
if(!pdo_fieldexists("fy_lesson_setting", "sitename")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `sitename` varchar(100) DEFAULT NULL;");
}
if(!pdo_fieldexists("fy_lesson_setting", "banner")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `banner` text COMMENT '焦点图';");
}
if(!pdo_fieldexists("fy_lesson_setting", "adv")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `adv` text NOT NULL COMMENT '课程详情页广告';");
}
if(!pdo_fieldexists("fy_lesson_setting", "copyright")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `copyright` varchar(255) NOT NULL COMMENT '版权';");
}
if(!pdo_fieldexists("fy_lesson_setting", "closespace")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `closespace` int(4) NOT NULL DEFAULT '60' COMMENT '关闭未付款订单时间间隔';");
}
if(!pdo_fieldexists("fy_lesson_setting", "closelast")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `closelast` int(10) NOT NULL DEFAULT '0' COMMENT '上次执行关闭未付款订单时间';");
}
if(!pdo_fieldexists("fy_lesson_setting", "savetype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `savetype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0.其他存储方式 1.七牛云存储 2.腾讯云存储';");
}
if(!pdo_fieldexists("fy_lesson_setting", "qiniu")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `qiniu` text NOT NULL COMMENT '七牛云存储参数';");
}
if(!pdo_fieldexists("fy_lesson_setting", "qcloud")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `qcloud` text COMMENT '腾讯云存储';");
}
if(!pdo_fieldexists("fy_lesson_setting", "vipdiscount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `vipdiscount` int(3) NOT NULL DEFAULT '0' COMMENT 'vip会员购买课程折扣';");
}
if(!pdo_fieldexists("fy_lesson_setting", "teacher_income")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `teacher_income` tinyint(1) NOT NULL DEFAULT '0' COMMENT '讲师申请 0.关闭 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_setting", "isfollow")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `isfollow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '引导关注公众号 0.关闭 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_setting", "qrcode")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `qrcode` varchar(255) DEFAULT NULL COMMENT '公众号二维码';");
}
if(!pdo_fieldexists("fy_lesson_setting", "mustinfo")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `mustinfo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '下单前必须完善手机号码和姓名';");
}
if(!pdo_fieldexists("fy_lesson_setting", "user_info")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `user_info` text COMMENT '填写选项(以json格式保存)';");
}
if(!pdo_fieldexists("fy_lesson_setting", "mobilechange")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `mobilechange` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启修改手机链接 0.关闭 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_setting", "autogood")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `autogood` int(4) NOT NULL DEFAULT '0' COMMENT '超时自动好评 默认0为关闭';");
}
if(!pdo_fieldexists("fy_lesson_setting", "posterbg")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `posterbg` varchar(255) DEFAULT NULL COMMENT '推广海报背景图';");
}
if(!pdo_fieldexists("fy_lesson_setting", "teacherlist")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `teacherlist` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0.不显示 1.讲师列表  2.VIP会员  3.优惠券中心';");
}
if(!pdo_fieldexists("fy_lesson_setting", "category_ico")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `category_ico` varchar(255) NOT NULL COMMENT '所有分类图标';");
}
if(!pdo_fieldexists("fy_lesson_setting", "index_lazyload")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `index_lazyload` text COMMENT '首页延迟加载';");
}
if(!pdo_fieldexists("fy_lesson_setting", "self_diy")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `self_diy` text COMMENT '个人中心自定义栏目';");
}
if(!pdo_fieldexists("fy_lesson_setting", "stock_config")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `stock_config` tinyint(1) DEFAULT '0' COMMENT '是否启用库存 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_setting", "is_invoice")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `is_invoice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开具发票 0.不支持 1.支持';");
}
if(!pdo_fieldexists("fy_lesson_setting", "lesson_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `lesson_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程详情页默认显示';");
}
if(!pdo_fieldexists("fy_lesson_setting", "follow_word")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `follow_word` varchar(100) DEFAULT NULL COMMENT '引导关注提示语';");
}
if(!pdo_fieldexists("fy_lesson_setting", "audit_evaluate")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `audit_evaluate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '课程评价是否需要审核  0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_setting", "visit_limit")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `visit_limit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '非微信端访问 0.不允许 1.允许';");
}
if(!pdo_fieldexists("fy_lesson_setting", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `addtime` int(10) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_setting", "login_visit")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `login_visit` text COMMENT '需要登录访问的控制器';");
}
if(!pdo_fieldexists("fy_lesson_setting", "poster_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `poster_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '推广海报样式 1.直接进入微课堂  2.直接进入公众号';");
}
if(!pdo_fieldexists("fy_lesson_setting", "show_newlesson")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `show_newlesson` tinyint(2) NOT NULL DEFAULT '0' COMMENT '首页显示最新课程数量';");
}
if(!pdo_fieldexists("fy_lesson_setting", "lesson_follow_title")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `lesson_follow_title` varchar(255) DEFAULT NULL COMMENT '课程页强制关注标题';");
}
if(!pdo_fieldexists("fy_lesson_setting", "lesson_follow_desc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `lesson_follow_desc` varchar(255) DEFAULT NULL COMMENT '课程页强制关注描述';");
}
if(!pdo_fieldexists("fy_lesson_setting", "receive_coupon")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `receive_coupon` varchar(255) DEFAULT NULL COMMENT '优惠券到账通知';");
}
if(!pdo_fieldexists("fy_lesson_setting", "self_setting")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `self_setting` tinyint(1) NOT NULL DEFAULT '0' COMMENT '前端个人中心“设置”按钮';");
}
if(!pdo_fieldexists("fy_lesson_setting", "sale_desc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `sale_desc` text COMMENT '推广海报页面说明';");
}
if(!pdo_fieldexists("fy_lesson_setting", "dayu_sms")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `dayu_sms` text COMMENT '大于短信配置信息';");
}
if(!pdo_fieldexists("fy_lesson_setting", "modify_mobile")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `modify_mobile` tinyint(1) NOT NULL DEFAULT '0' COMMENT '修改手机号码';");
}
if(!pdo_fieldexists("fy_lesson_setting", "poster_config")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `poster_config` text COMMENT '海报参数设置';");
}
if(!pdo_fieldexists("fy_lesson_setting", "qun_service")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `qun_service` text COMMENT '加群客服人员';");
}
if(!pdo_fieldexists("fy_lesson_setting", "index_verify")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `index_verify` text COMMENT '首页验证绑定选项';");
}
if(!pdo_fieldexists("fy_lesson_setting", "search_box")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `search_box` text COMMENT '首页搜索框';");
}
if(!pdo_fieldexists("fy_lesson_setting", "open_https")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `open_https` tinyint(1) NOT NULL DEFAULT '0' COMMENT '强制https 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_setting", "show_teacher_income")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   `show_teacher_income` tinyint(1) NOT NULL DEFAULT '1' COMMENT '后台发布课程显示讲师分成';");
}
if(!pdo_fieldexists("fy_lesson_setting", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_setting")." ADD   UNIQUE KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_son", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_son", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_son", "parentid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `parentid` int(11) NOT NULL COMMENT '课程关联id';");
}
if(!pdo_fieldexists("fy_lesson_son", "title")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `title` varchar(255) NOT NULL COMMENT '章节名称';");
}
if(!pdo_fieldexists("fy_lesson_son", "savetype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `savetype` tinyint(1) NOT NULL COMMENT '存储方式 0.其他存储 1.七牛存储 2.内嵌播放代码模式';");
}
if(!pdo_fieldexists("fy_lesson_son", "sectiontype")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `sectiontype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '章节类型 1.视频章节 2.图文章节';");
}
if(!pdo_fieldexists("fy_lesson_son", "videourl")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `videourl` text COMMENT '章节视频url';");
}
if(!pdo_fieldexists("fy_lesson_son", "videotime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `videotime` varchar(100) NOT NULL COMMENT '视频时长';");
}
if(!pdo_fieldexists("fy_lesson_son", "content")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `content` longtext COMMENT '章节内容';");
}
if(!pdo_fieldexists("fy_lesson_son", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `displayorder` int(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fy_lesson_son", "is_free")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `is_free` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为试听章节 0.否 1.是';");
}
if(!pdo_fieldexists("fy_lesson_son", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示 0.隐藏 1.显示';");
}
if(!pdo_fieldexists("fy_lesson_son", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `addtime` int(10) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_son", "auto_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `auto_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '自动上架 0.关闭 1.开启';");
}
if(!pdo_fieldexists("fy_lesson_son", "show_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `show_time` int(11) NOT NULL DEFAULT '0' COMMENT '自动上架时间';");
}
if(!pdo_fieldexists("fy_lesson_son", "test_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `test_time` int(4) NOT NULL DEFAULT '0' COMMENT '试听时间(单位:秒，0为关闭)';");
}
if(!pdo_fieldexists("fy_lesson_son", "images")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   `images` varchar(255) DEFAULT NULL COMMENT '章节封面图';");
}
if(!pdo_fieldexists("fy_lesson_son", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_son", "idx_parentid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   KEY `idx_parentid` (`parentid`);");
}
if(!pdo_fieldexists("fy_lesson_son", "idx_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_son")." ADD   KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_spec", "spec_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD   `spec_id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_spec", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_spec", "lessonid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD   `lessonid` int(11) NOT NULL COMMENT '课程id';");
}
if(!pdo_fieldexists("fy_lesson_spec", "spec_day")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD   `spec_day` int(11) DEFAULT NULL COMMENT '有效期(天)';");
}
if(!pdo_fieldexists("fy_lesson_spec", "spec_price")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD   `spec_price` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_spec", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD 2) DEFAULT '0.00' COMMENT '规格价格';");
}
if(!pdo_fieldexists("fy_lesson_spec", "spec_stock")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD   `spec_stock` int(11) DEFAULT NULL COMMENT '库存';");
}
if(!pdo_fieldexists("fy_lesson_spec", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_spec")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_static", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_static", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD   `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fy_lesson_static", "lessonOrder_num")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD   `lessonOrder_num` int(11) NOT NULL DEFAULT '0' COMMENT '课程订单总量';");
}
if(!pdo_fieldexists("fy_lesson_static", "lessonOrder_amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD   `lessonOrder_amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_static", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT '课程订单总额';");
}
if(!pdo_fieldexists("fy_lesson_static", "vipOrder_num")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD   `vipOrder_num` int(11) NOT NULL DEFAULT '0' COMMENT 'vip订单总量';");
}
if(!pdo_fieldexists("fy_lesson_static", "vipOrder_amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD   `vipOrder_amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_static", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD 2) NOT NULL DEFAULT '0.00' COMMENT 'VIP订单总额';");
}
if(!pdo_fieldexists("fy_lesson_static", "static_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_static")." ADD   `static_time` int(11) NOT NULL COMMENT '统计日期';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_syslog", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "admin_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `admin_uid` int(11) DEFAULT NULL COMMENT '管理员id';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "admin_username")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `admin_username` varchar(50) DEFAULT NULL COMMENT '管理员昵称';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "log_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `log_type` tinyint(1) DEFAULT NULL COMMENT '操作类型 1.增加 2.删除 3更新';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "function")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `function` varchar(100) DEFAULT NULL COMMENT '操作的功能';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "content")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `content` varchar(1000) DEFAULT NULL COMMENT '操作描述';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "ip")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `ip` varchar(50) DEFAULT NULL COMMENT '操作IP地址';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   `addtime` int(10) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_syslog", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_syslog", "idx_admin_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   KEY `idx_admin_uid` (`admin_uid`);");
}
if(!pdo_fieldexists("fy_lesson_syslog", "idx_log_type")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   KEY `idx_log_type` (`log_type`);");
}
if(!pdo_fieldexists("fy_lesson_syslog", "idx_function")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   KEY `idx_function` (`function`);");
}
if(!pdo_fieldexists("fy_lesson_syslog", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_syslog")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_teacher", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_teacher", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "account")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `account` varchar(20) DEFAULT NULL COMMENT '讲师登录帐号';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "password")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `password` varchar(32) DEFAULT NULL COMMENT '讲师登录密码';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "teacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `teacher` varchar(100) NOT NULL COMMENT '讲师名称';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "qq")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `qq` varchar(20) DEFAULT NULL COMMENT '讲师QQ';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "qqgroup")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `qqgroup` varchar(20) DEFAULT NULL COMMENT '讲师QQ群';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "qqgroupLink")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `qqgroupLink` varchar(255) DEFAULT NULL COMMENT 'QQ群加群链接';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "weixin_qrcode")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `weixin_qrcode` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fy_lesson_teacher", "first_letter")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `first_letter` varchar(10) DEFAULT NULL COMMENT '讲师名称首字母拼音';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "teacherdes")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `teacherdes` text COMMENT '讲师介绍';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "teacherphoto")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `teacherphoto` varchar(255) DEFAULT NULL COMMENT '讲师相片';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '讲师状态 -1.审核不通过 1.正常 2.审核中';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "upload")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `upload` tinyint(1) NOT NULL DEFAULT '1' COMMENT '上传权限 0.禁止 1.允许';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "teacher_income")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   `teacher_income` tinyint(2) NOT NULL DEFAULT '0' COMMENT '讲师分成(单位%)';");
}
if(!pdo_fieldexists("fy_lesson_teacher", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_teacher", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_teacher", "idx_account")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   KEY `idx_account` (`account`);");
}
if(!pdo_fieldexists("fy_lesson_teacher", "idx_status")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists("fy_lesson_teacher", "idx_upload")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher")." ADD   KEY `idx_upload` (`upload`);");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "teacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `teacher` varchar(255) DEFAULT NULL COMMENT '讲师名称';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `ordersn` varchar(100) DEFAULT NULL COMMENT '订单编号';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `bookname` varchar(255) DEFAULT NULL COMMENT '课程名称';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "orderprice")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `orderprice` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD 2) DEFAULT '0.00' COMMENT '订单价格';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "teacher_income")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `teacher_income` tinyint(3) DEFAULT NULL COMMENT '讲师分成';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "income_amount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `income_amount` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD 2) DEFAULT '0.00' COMMENT '讲师实际收入';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   `addtime` int(10) DEFAULT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "idx_teacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   KEY `idx_teacher` (`teacher`);");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "idx_ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   KEY `idx_ordersn` (`ordersn`);");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "idx_bookname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   KEY `idx_bookname` (`bookname`);");
}
if(!pdo_fieldexists("fy_lesson_teacher_income", "idx_addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_teacher_income")." ADD   KEY `idx_addtime` (`addtime`);");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "buysucc")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `buysucc` varchar(255) DEFAULT NULL COMMENT '用户购买成功通知';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "cnotice")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `cnotice` varchar(255) DEFAULT NULL COMMENT '佣金提醒';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "newjoin")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `newjoin` varchar(255) DEFAULT NULL COMMENT '下级代理商加入提醒';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "newlesson")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `newlesson` varchar(255) DEFAULT NULL COMMENT '课程通知';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "neworder")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `neworder` varchar(255) DEFAULT NULL COMMENT '订单通知(管理员)';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "newcash")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `newcash` varchar(255) DEFAULT NULL COMMENT '提现申请通知(管理员)';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "apply_teacher")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `apply_teacher` varchar(255) DEFAULT NULL COMMENT '申请讲师入驻审核通知';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "receive_coupon")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `receive_coupon` varchar(255) DEFAULT NULL COMMENT '优惠券到账通知';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `update_time` int(11) DEFAULT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "buysucc_format")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `buysucc_format` text COMMENT '购买成功模版消息格式';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "cnotice_format")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `cnotice_format` text COMMENT '佣金提醒模版消息格式';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "newjoin_format")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `newjoin_format` text COMMENT '下级代理商加入模版消息格式';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "neworder_format")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `neworder_format` text COMMENT '订单通知(管理员)模版消息格式';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "newcash_format")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `newcash_format` text COMMENT '提现申请通知模版消息格式';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "apply_teacher_format")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `apply_teacher_format` text COMMENT '讲师申请通知模版消息格式';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "receive_coupon_format")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   `receive_coupon_format` text COMMENT '优惠券到账模版消息格式';");
}
if(!pdo_fieldexists("fy_lesson_tplmessage", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_tplmessage")." ADD   KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "level_name")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `level_name` varchar(100) DEFAULT NULL COMMENT 'vip等级名称';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "level_validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `level_validity` int(11) DEFAULT NULL COMMENT '有效期';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "level_price")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `level_price` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD 2) DEFAULT NULL COMMENT '价格';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "discount")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `discount` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '购买课程折扣 0.没有折扣';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "sort")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `sort` int(4) DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "is_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示状态 0.隐藏  1.显示';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "integral")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `integral` int(11) NOT NULL DEFAULT '0' COMMENT '赠送积分';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "commission")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `commission` text COMMENT '佣金比例';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   `update_time` int(11) NOT NULL COMMENT '更新时间';");
}
if(!pdo_fieldexists("fy_lesson_vip_level", "idx_is_show")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vip_level")." ADD   KEY `idx_is_show` (`is_show`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "card_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `card_id` varchar(50) DEFAULT NULL COMMENT '卡号';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "password")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `password` varchar(100) DEFAULT NULL COMMENT '服务卡密码';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "level_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `level_id` int(11) NOT NULL COMMENT 'VIP等级ID';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "viptime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `viptime` decimal(10;");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD 2) DEFAULT NULL COMMENT '服务卡时长';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "is_use")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0.未使用 1.已使用';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `nickname` varchar(100) DEFAULT NULL COMMENT '会员昵称';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `uid` int(11) DEFAULT NULL COMMENT '会员id';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `ordersn` varchar(50) DEFAULT NULL COMMENT '使用订单编号(对应vip订单表的ordersn)';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "use_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `use_time` int(10) DEFAULT NULL COMMENT '使用时间';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `validity` int(10) DEFAULT NULL COMMENT '有效期';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "addtime")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间';");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_card_id")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_card_id` (`card_id`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_is_use")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_is_use` (`is_use`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_uid")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_uid` (`uid`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_nickname")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_nickname` (`nickname`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_ordersn")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_ordersn` (`ordersn`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_validity")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_validity` (`validity`);");
}
if(!pdo_fieldexists("fy_lesson_vipcard", "idx_use_time")) {
 pdo_query("ALTER TABLE ".tablename("fy_lesson_vipcard")." ADD   KEY `idx_use_time` (`use_time`);");
}

 ?>