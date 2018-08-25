<?php
/**
 * 二维码推广 - 带参数
 * ============================================================================
 * 版权所有 2015-2018 微课堂团队，并保留所有权利。
 * 网站地址: https://wx.haoshu888.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！不允许对程序代码以任何形式任何目的的再发布，作者将保留
 * 追究法律责任的权力和最终解释权。
 */

checkauth();
$uid = $_W['member']['uid'];
$title = "个人专属海报";

if($comsetting['is_sale']==0){
	message("系统未开启该功能", "", "warning");
}

$member = pdo_fetch("SELECT a.*,b.avatar,b.nickname AS mc_nickname FROM " .tablename($this->table_member). " a LEFT JOIN ".tablename($this->table_mc_members). " b ON a.uid=b.uid WHERE a.uniacid=:uniacid AND a.uid=:uid", array(':uniacid'=>$uniacid,':uid'=>$uid));

$memberVip = pdo_fetchall("SELECT * FROM " .tablename($this->table_member_vip). " WHERE uid=:uid AND validity>:validity", array(':uid'=>$uid,':validity'=>time()));
if($comsetting['sale_rank']==2 && empty($memberVip)){
	message("您不是VIP会员，无法访问该功能", $this->createMobileUrl('index'), "warning");
}
if($member['status']!=1){
	message("您的分销身份未激活", $this->createMobileUrl('index'), "warning");
}

$sale_desc = $comsetting['sale_desc'] ? explode("\n", $comsetting['sale_desc']) : "";

/* 分享设置 */
load()->model('mc');
$sharelink = unserialize($comsetting['sharelink']);
$shareurl = $_W['siteroot'] .'app/'. $this->createMobileUrl('index', array('uid'=>$uid));

/* 海报配置参数 */
$poster = json_decode($setting['poster_config'], true);
$qrcode_left = intval($poster['qrcode_left'])>0 ? $poster['qrcode_left'] : 473;
$qrcode_top = intval($poster['qrcode_top'])>0 ? $poster['qrcode_top'] : 733;
$avatar_left = intval($poster['avatar_left'])>0 ? $poster['avatar_left'] : 22;
$avatar_top = intval($poster['avatar_top'])>0 ? $poster['avatar_top'] : 698;
$nickname_left = intval($poster['nickname_left'])>0 ? $poster['nickname_left'] : 210;
$nickname_top = intval($poster['nickname_top'])>0 ? $poster['nickname_top'] : 728;
$nickname_fontsize = intval($poster['nickname_fontsize'])>0 ? $poster['nickname_fontsize'] : 24;
if(!empty($poster['nickname_fontcolor'])){
	$font_color = $this->hexTorgb($poster['nickname_fontcolor']);
}else{
	$font_color['r'] = $font_color['g'] = $font_color['b'] = 255;
}

$this->checkdir("../attachment/images/fy_lessonv2/");
$this->checkdir("../attachment/images/fy_lessonv2/{$uniacid}/");
$dirpath = "../attachment/images/fy_lessonv2/{$uniacid}/";

$imagepath = $dirpath.$uniacid."_".$uid."_ok.png";
if(!file_exists($imagepath) || $comsetting['qrcode_cache']==0 || filectime($imagepath) > time() + 7*86400){
	set_time_limit(60); 
	ignore_user_abort(true); 
	include(IA_ROOT."/framework/library/qrcode/phpqrcode.php");

	/* 背景图片 */
	if(empty($setting['posterbg'])){
		$bgimg = "../addons/fy_lessonv2/template/mobile/images/posterbg.jpg";
	}else{
		$bgimg = "../attachment/images/fy_lessonv2/{$uniacid}/posterbg.jpg";
		if(!file_exists($bgimg)){
			$this->saveImage($_W['attachurl'].$setting['posterbg'], $dirpath."posterbg.", '');
		}
	}

	/* 获取带参数二维码 */
	$codeArray = array (
		'expire_seconds' => 2592000,
		'action_name' => QR_LIMIT_STR_SCENE,
		'action_info' => array (
			'scene' => array (
				'scene_str' => "uid_{$uid}",
			),
		),
	);
	$account_api = WeAccount::create();
	$res = $account_api->barCodeCreateFixed($codeArray);

	if(empty($res['ticket'])){
		message("获取二维码失败，错误信息:".$res['errcode']."，".$res['errmsg']);
	}
	$qrcodeurl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$res['ticket'];
	$this->saveImage($qrcodeurl, $dirpath.$uniacid."_".$uid."_qrcode.");
	$this->resize($dirpath.$uniacid."_".$uid."_qrcode.jpg", $dirpath.$uniacid."_".$uid."_qrcode.jpg", "150", "150", "100");

	/* 合成二维码 */
	$savefield = $this->img_water_mark($bgimg, $dirpath.$uniacid."_".$uid."_qrcode.jpg", $dirpath, $uniacid."_".$uid.".png", $qrcode_left, $qrcode_top);
	
	/* 合成头像 */
	if($poster['avatar_show']==1){
		if(empty($member['avatar'])){
			$avatar = MODULE_URL."template/mobile/images/default_avatar.jpg";
		}else{
			$inc = strstr($member['avatar'], "http://") || strstr($member['avatar'], "https://");
			$avatar = $inc ? $member['avatar'] : $_W['attachurl'].$member['avatar'];
		}
		
		$suffix = $this->saveImage($avatar, $dirpath.$uniacid."_".$uid."_avatar.", 'avatar');

		$avatar_size = filesize($dirpath.$uniacid."_".$uid."_avatar.".$suffix);
		if($avatar_size==0){
			message("获取头像失败，请在个人中心点击头像更新", $this->createMobileUrl('self'), "error");
		}

		if($suffix=='png'){
			$im = imagecreatefrompng($dirpath.$uniacid."_".$uid."_avatar.".$suffix);
		}elseif($suffix=='jpeg' || $suffix=='jpg'){
			$im = imagecreatefromjpeg($dirpath.$uniacid."_".$uid."_avatar.".$suffix);
		}else{
			$im = imagecreatefromjpeg(MODULE_URL."template/mobile/images/default_avatar.jpg");
		}
		imagejpeg($im, $dirpath.$uniacid."_".$uid."_avatar.jpg");
		imagedestroy($im);
		
		$this->resize($dirpath.$uniacid."_".$uid."_avatar.jpg", $dirpath.$uniacid."_".$uid."_avatar.jpg", "100", "100", "100");
		$savefield = $this->img_water_mark($savefield, $dirpath.$uniacid."_".$uid."_avatar.jpg", $dirpath, $uniacid."_".$uid."_ok.png", $avatar_left, $avatar_top);
	}

	/* 合成昵称 */
	$info = getimagesize($savefield);  
	/* 通过编号获取图像类型 */ 
	$type = image_type_to_extension($info[2],false);  
	/* 图片复制到内存 */
	$image = imagecreatefromjpeg($savefield);  
	  
	/* 合成昵称 */
	if($poster['nickname_show']==1){
		/* 设置字体的路径 */
		$font = MODULE_ROOT."/template/mobile/ttf/yahei.ttf";
		/* 设置字体颜色和透明度 */
		$color = imagecolorallocatealpha($image, $font_color['r'], $font_color['g'], $font_color['b'], 0);
		/* 写入文字 */
		$fun = $dirpath.$uniacid."_".$uid.".png";
		imagettftext($image, $nickname_fontsize, 0, $nickname_left, $nickname_top, $color, $font, $member['mc_nickname']);
	}
	
	/* 保存图片 */
	$fun = "image".$type;
	$okfield = $dirpath.$uniacid."_".$uid."_ok.png";
	$fun($image, $okfield);  
	/*销毁图片*/  
	imagedestroy($image);
	
	/* 删除多余文件 */
	unlink($dirpath.$uniacid."_".$uid.".png");
	unlink($dirpath.$uniacid."_".$uid."_qrcode.jpg");
	unlink($dirpath.$uniacid."_".$uid."_avatar.jpg");
}

$imagepath = $dirpath.$uniacid."_".$uid."_ok.png?v=".time();

include $this->template('qrcode');

?>