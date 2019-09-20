<?php 

$user = Yii::$app->user->identity;

?>
<style type="text/css">
	.blog {
		padding: 20px;
		background: #dcd3d3;
	}
</style>
<div class="container">
	<div class="row">
		<?php if ($user): ?>
			<div class="col-md-6">
				<form>
					<h2>Konvertatsia</h2><br>
					<div class="col-md-6 form-group">
						<select class="others-group form-control">
							<?php if ($data['rates']): ?>
								<?php foreach ($data['rates'] as $key => $value) {
									if ($key == 'UZS') { continue; } ?>
								  <option id="<?=$key?>" value="<?=$value?>"><?=$key?></option>
								<?php } ?>
							<?php endif ?>
						</select>
						<input class="form-control" type="text" id="input-one" name="other">
					</div>
					<div class="col-md-6 form-group">
						<select class="uzs-group form-control">
							  <option id="UZS" value="<?=$data_uz?>">UZB SO'M</option>
						</select>
						<input class="form-control" type="text" id="input-uzs" name="uzs">
					</div>
				</form>
			</div>

			<div class="col-md-12">
				<form id="comment" method="post">
					<h2>Komentariyada o'z fikringizni qoldirishingiz mumkin</h2><br>
					<div class="blog col-md-6">
						<div class="col-md-12 form-group">
							<textarea class="form-control area" type="textarea" id="area" name="comment-field"></textarea>
							<button type="button" id="send-btn" class="pull-right btn btn-success btn-sm">Send</button>
						</div>
						<div class="col-md-12" id="place">
							<?php foreach ($comments as $key => $value) { ?>
								<footer class="comment-meta" style="margin-bottom: 20px;">
									<div class="comment-author vcard">
										<img alt="" src="" class="avatar avatar-32 photo" height="32" width="32">						
										<b class="fn"><?= $value['user']['email']?></b> <span class="says">izohi:</span>
									</div>

									<div class="comment-metadata">
										<a href="https://lifehaq.uz/nega-yoshimiz-ulg-aygan-sari-do-stlarimizni-yo-qotib-boramiz/#comment-34">
											<time ><?= date('Y-m-d H:i:s', $value['created_at']) ?></time>
										</a>
									</div><!-- .comment-metadata -->

									<em class="comment-awaiting-moderation"><?=$value['content']?></em>
								</footer>
								<hr>
							<?php } ?>
							
							
						</div>
					</div>
				</form>
			</div>
		<?php else: ?>
			<div class="col-md-6">
				<h3>Bu bo'limdan foydalanishlik uchun <a href="/site/login">tizimga kirish</a> talab etiladi</h3>
			</div>
		<?php endif ?>
	</div>
</div>


