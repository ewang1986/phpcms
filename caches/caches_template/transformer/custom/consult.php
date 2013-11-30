<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>xingwang/consult.css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>xingwang/watermark.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>jquery.validate.js" charset="UTF-8"></script>
<style type="text/css">
	.page-panel .send{
		background:url(<?php echo IMG_PATH;?>xingwang/send.png);
		background-repeat: no-repeat;
	}
</style>

				<div id="pagePanel" class="page-panel">
					<div class="desc"><?php echo $desc;?></div>
					<div class="content">
                        <form id="myform" method="post" action="?m=custom&c=consult&a=send">
							<div class="item">
								<span class="user-text">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span>
								<input class="user-input-name" type="text" name="username" id="username" />
								<input class="user-radio" name="radioSex" type="radio" name="sex" value="1" checked="checked"> 
								<span class="user-sex">先&nbsp;&nbsp;生</span>
								<input class="user-radio" name="radioSex" type="radio" name="sex" value="0">
								<span class="user-sex">小&nbsp;&nbsp;姐</span>
							</div>
							<div class="item">
								<span class="user-text">联络电话</span>
								<input class="user-input" type="text" name="phone" id="phone"/>
							</div>
							<div class="item">
								<span class="user-text">电子信箱</span>
								<input class="user-input" type="text" name="email" id="email"/>
							</div>
							<div class="item">
								<span class="user-text">预约时间</span>
								<input id="userTime" class="user-input" type="text" name="appointment"/>
							</div>
							<div class="item">
								<span class="user-text consult-time">咨询时段</span>
								<span class="container">
									<input class="radio-icon" type="radio" name="duration" value="09:00~09:30" checked="checked"> 
									<span class="user-time">09:00~09:30</span>
									<input class="radio-icon" type="radio" name="duration" value="10:30~11:00">
									<span class="user-time">10:30~11:00</span>
									</br>
									<input class="radio-icon" type="radio" name="duration" value="09:30~10:00"> 
									<span class="user-time">09:30~10:00</span>
									<input class="radio-icon" type="radio" name="duration" value="11:00~11:30">
									<span class="user-time">11:00~11:30</span>
									</br>
									<input class="radio-icon" type="radio" name="duration" value="10:00~10:30"> 
									<span class="user-time">10:00~10:30</span>
									<input class="radio-icon" type="radio" name="duration" value="10:00~10:30">
									<span class="user-time">11:30~12:00</span>
								</span>
							</div>
							<div class="item">
								<span class="user-text">主&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旨</span>
								<input id="topic" class="user-input" type="text" name="topic" />
							</div>
							<div class="item">
								<span class="user-text consult-content">咨询内容</span>
								<textarea id="content" class="user-textarea" name="content"></textarea>
							</div>
							<div class="item">
								<span class="code-panel">
									<span class="user-text">验&nbsp;&nbsp;证&nbsp;&nbsp;码</span>
									<input id="vcode" class="user-input-code" type="text" name="vcode"/>
									<span class="warn">*请输入右方图片所显示的文字</span>
								</span>
								<!-- image class="code-image" src="images/code.png"></image-->
                                <?php echo form::checkcode('checkcode', 5, 20, 130, 50, '', '', '', 'code-image'); ?>
							</div>
							<div class="item send-item">
								<input class="send" type="button" value='送&nbsp;&nbsp;&nbsp;&nbsp;出' id="dosubmit" name="dosubmit">
							</div>
						</form>
					</div>
				</div>
<script type="text/javascript">
	$(function() {
		var $userTime = $('#userTime'),
			$username = $('#username'),
			$phone = $('#phone'),
			$vcode = $('#vcode'),
			$myform = $('#myform'),
			$email = $('#email'),
			$topic = $('#topic'),
			$dosubmit = $('#dosubmit'),
			$content = $('#content');

		$dosubmit.on('click',doSubmit);

		function doSubmit(){

			if($.trim($username.val()) == ''){
				$username.focus();
				notification.tipIn($username,'姓名不能为空!');
			}else if($.trim($phone.val()) == ''){
				$phone.focus();
				notification.tipIn($phone,'电话号码不能为空!');
			}else if(!utils.checkEmail($.trim($email.val()))){
				$email.focus();
				notification.tipIn($email,'电子信箱格式错误!');
			}else if(!$.validator.methods['isDate']($userTime.val())){
				$userTime.focus();
				notification.tipIn($userTime,'请输入正确的日期!');
			}else if($.trim($topic.val()) == ''){
				$topic.focus();
				notification.tipIn($topic,'主旨不能为空!');
			}else if($.trim($vcode.val()) == ''){
				$vcode.focus();
				notification.tipIn($vcode,'验证码不能为空!');
			}else{
				$myform[0].submit();
			}
		}

		$.validator.addMethod("isDate", function(value){
			var ereg = /^(\d{1,4})(-|\/)(\d{1,2})(-|\/)(\d{1,2})$/,
				r = value.match(ereg);
			if (r == null) {
				return false;
			}
			return true;
		});

		$userTime.watermark('请输入正确的时间格式:YYYY-MM-DD');
		$vcode.watermark('请输入验证码');
		$topic.watermark('请输入主旨');
		$content.watermark('请输入咨询内容');
		$username.watermark('请填写正确的姓名');
		$phone.watermark('请填写正确的电话号码');
		$email.watermark('请填写正确的电子信箱');
	});
</script>
<?php include template("content","footer"); ?>
