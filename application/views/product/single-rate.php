<div class="review_form_area">
                                                    <div class="review_form">
                                                        <div class="revew_form_content">
                                                            <h3 id="reply-title" class="comment-reply-title">
                                                                أضف تقييم
                                                            </h3>
                                                            <?php if(isset($_SESSION['i'])){ ?>
                                                            <div id="commentform" class="comment-form">
                                                                <input type="hidden" name="rate_value" id="rate_value"
                                                                    value="">
                                                                <input type="hidden" name="product" id="product"
                                                                    value="<?=$single['ID'];?>">
                                                                <div class="comment-form-rating">
                                                                    <label class="comment">التقييم</label>
                                                                    <div
                                                                        class="price_rating price_rating_2 price_rating_3">
                                                                        <a href="#" data-value="20">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </a>
                                                                        <a href="#" data-value="40">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </a>
                                                                        <a href="#" data-value="60">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </a>
                                                                        <a href="#" data-value="80">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </a>
                                                                        <a href="#" data-value="100">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </a>

                                                                        <span id="rating_span"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-form-comment">
                                                                    <label class="comment">تقييمك</label>
                                                                    <textarea id="comment" aria-required="true" rows="8"
                                                                        cols="45" name="comment"></textarea>
                                                                </div>
                                                                <div class="form-submit">
                                                                    <input id="makeComment" class="submt" type="submit"
                                                                        value="تأكيد" name="submit">
                                                                </div>
                                                                <div id="commentHints" class="text-center"></div>
                                                            </div>
                                                            <?php }else{
							    $this->shop->alert('عفواً تقييم المنتجات متاح للأعضاء فقط<br />'
								    . 'قم بتسجيل الدخول او بتسجيل عضوية من هذا '
								    . '<a href="'.base_url().'login">الرابط</a>');
							}
							?>
                                                        </div>
                                                    </div>
                                                </div>