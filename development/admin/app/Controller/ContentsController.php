<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/06							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	地区管理画面					*/
/*	ContentsController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class ContentsController extends AppController{

	public $uses=array(
		"Additems",
		"Contents",
		"Category",
		"District",
	);

	public $components=array(
		"Db",
		"Loadbasic",
		"Csv",
		"Curl",
	);

	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	//★コンテンツ一覧
	public function index($page=1){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);
		
		
		//カテゴリー情報をset
		$category_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"0",						
			),
		));
		$this->set("category_list",$category_list);
		
		//地区情報をset
		$district_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"1",						
			),
		));
		$this->set("district_list",$district_list);		
		
		//コンテンツ情報をset
		$result=$this->Contents->find("all",array(
			'order' => array(
				'Contents.id' => 'desc',
			),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$result=$this->Contents->find("count");
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
	}
	
	
	
	//★コンテンツ登録・編集
	public function edit($id=null){
		
		$locationarea=$this->Db->locationarea();	
		$this->set("locationarea",$locationarea);
				
		$domain_item=$this->Loadbasic->load("itemurl");	
		$this->set("domain_item",$domain_item);
				
		//カテゴリー情報をset
		$category_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"0",						
			),
		));
		$this->set("category_list",$category_list);
		
		//地区情報をset
		$district_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"1",						
			),
		));
		$this->set("district_list",$district_list);		

		if($this->request->data){
			$post=$this->request->data;

			$this->Contents->set($post);
			if($this->Contents->validates()){
				
				try{
					
								$this->Contents->begin();
								
								//詳細情報をJSON化して登録・更新
								$caption=json_encode(array(
									"ttl1"=>$post["Contents"]["ttl1"],
									"ttl2"=>$post["Contents"]["ttl2"],
									"ttl3"=>$post["Contents"]["ttl3"],
									"ttl4"=>$post["Contents"]["ttl4"],
									"ttl5"=>$post["Contents"]["ttl5"],
									"text1"=>$post["Contents"]["text1"],
									"text2"=>$post["Contents"]["text2"],
									"text3"=>$post["Contents"]["text3"],
									"text4"=>$post["Contents"]["text4"],
									"text5"=>$post["Contents"]["text5"],
								),JSON_UNESCAPED_UNICODE);
								$post["Contents"]["caption"]=$caption;
				
								//店舗情報をJSON化して登録・更新
								$shop_info=json_encode(array(
									"postnumber"=>$post["Contents"]["postnumber"],
									"address1"=>$post["Contents"]["address1"],
									"address2"=>$post["Contents"]["address2"],
									"tel"=>$post["Contents"]["tel"],
									"shop_text"=>$post["Contents"]["shop_text"],	
								),JSON_UNESCAPED_UNICODE);
								$post["Contents"]["shop_info"]=$shop_info;
								
						
								$save_result = $this->Contents->save($post,false);
								if(!$save_result){
									$this->Contents->rollback();
								}								

								//画像関連↓↓↓↓
								//上書き用の確認find					
								$find_additem0=$this->Additems->find("first",array(
									"conditions"=>array(
										"Additems.content_id"=>$id,
										"Additems.type"=>0,
									),
								));				
								$find_additem1=$this->Additems->find("first",array(
									"conditions"=>array(
										"Additems.content_id"=>$id,
										"Additems.type"=>1,
									),
								));								
								$find_additem2=$this->Additems->find("first",array(
									"conditions"=>array(
										"Additems.content_id"=>$id,
										"Additems.type"=>2,
									),
								));					
								$find_additem3=$this->Additems->find("first",array(
									"conditions"=>array(
										"Additems.content_id"=>$id,
										"Additems.type"=>3,
									),
								));	
								$find_additem4=$this->Additems->find("first",array(
									"conditions"=>array(
										"Additems.content_id"=>$id,
										"Additems.type"=>4,
									),
								));	
								$find_additem5=$this->Additems->find("first",array(
									"conditions"=>array(
										"Additems.content_id"=>$id,
										"Additems.type"=>5,
									),
								));	
				
								//メイン画像をadditemに追加する
								if($post["Contents"]["img_file_changed"]){
									
										$save=array(
											"Additems"=>array(
												"id"=>@$find_additem0["Additems"]["id"],
												"content_id"=>$save_result["Contents"]["id"],
												"type"=>0,
												"content"=>$post["Contents"]["img_file"],
											),						
										);
										
										$res = $this->Additems->save($save,false);
										if(!$res){
											$this->Additems->rollback();
										}
										
										//画像アップロード
										$url=$domain_item."content/save";
										$curl_params=array(
											"access_token"=>base64_encode($this->Loadbasic->load("img_service_secret").":".$this->Loadbasic->load("img_lisence_key")),
											"source"=>$post["Contents"]["img_file_source"],
											"filename"=>$post["Contents"]["img_file"],
										);
										$this->Curl->access($url,$curl_params);
								}
								
								//サブ画像をadditemに追加する
								if($post["Contents"]["img_file_changed_sub1"]){
						
										$save=array(
											"Additems"=>array(
												"id"=>@$find_additem1["Additems"]["id"],
												"content_id"=>$save_result["Contents"]["id"],
												"type"=>1,
												"content"=>$post["Contents"]["img_file_sub1"],
											),						
										);
				
										$res = $this->Additems->save($save,false);
										if(!$res){
											$this->Additems->rollback();
										}			
										
										$url=$domain_item."content/save";
										$curl_params=array(
											"access_token"=>base64_encode($this->Loadbasic->load("img_service_secret").":".$this->Loadbasic->load("img_lisence_key")),
											"source"=>$post["Contents"]["img_file_source_sub1"],
											"filename"=>$post["Contents"]["img_file_sub1"],
										);
										
										$this->Curl->access($url,$curl_params);
								}				
								
								if($post["Contents"]["img_file_changed_sub2"]){
										$save=array(
											"Additems"=>array(
												"id"=>@$find_additem2["Additems"]["id"],
												"content_id"=>$save_result["Contents"]["id"],
												"type"=>2,
												"content"=>$post["Contents"]["img_file_sub2"],
											),						
										);
				
										$res = $this->Additems->save($save,false);
										if(!$res){
											$this->Additems->rollback();
										}						
										
										$url=$domain_item."content/save";
										$curl_params=array(
											"access_token"=>base64_encode($this->Loadbasic->load("img_service_secret").":".$this->Loadbasic->load("img_lisence_key")),
											"source"=>$post["Contents"]["img_file_source_sub2"],
											"filename"=>$post["Contents"]["img_file_sub2"],
										);
										
										$this->Curl->access($url,$curl_params);
								}					
								
								if($post["Contents"]["img_file_changed_sub3"]){
										$save=array(
											"Additems"=>array(
												"id"=>@$find_additem3["Additems"]["id"],
												"content_id"=>$save_result["Contents"]["id"],
												"type"=>3,
												"content"=>$post["Contents"]["img_file_sub3"],
											),						
										);
				
										$res = $this->Additems->save($save,false);
										if(!$res){
											$this->Additems->rollback();
										}
										
										$url=$domain_item."content/save";
										$curl_params=array(
											"access_token"=>base64_encode($this->Loadbasic->load("img_service_secret").":".$this->Loadbasic->load("img_lisence_key")),
											"source"=>$post["Contents"]["img_file_source_sub3"],
											"filename"=>$post["Contents"]["img_file_sub3"],
										);
										
										$this->Curl->access($url,$curl_params);
								}					
								
								if($post["Contents"]["img_file_changed_sub4"]){
										$save=array(
											"Additems"=>array(
												"id"=>@$find_additem4["Additems"]["id"],
												"content_id"=>$save_result["Contents"]["id"],
												"type"=>4,
												"content"=>$post["Contents"]["img_file_sub4"],
											),						
										);
				
										$res = $this->Additems->save($save,false);
										if(!$res){
											$this->Additems->rollback();
										}
										
										$url=$domain_item."content/save";
										$curl_params=array(
											"access_token"=>base64_encode($this->Loadbasic->load("img_service_secret").":".$this->Loadbasic->load("img_lisence_key")),
											"source"=>$post["Contents"]["img_file_source_sub4"],
											"filename"=>$post["Contents"]["img_file_sub4"],
										);
										
										$this->Curl->access($url,$curl_params);
								}						
								
								if($post["Contents"]["img_file_changed_sub5"]){
										$save=array(
											"Additems"=>array(
												"id"=>@$find_additem5["Additems"]["id"],
												"content_id"=>$save_result["Contents"]["id"],
												"type"=>5,
												"content"=>$post["Contents"]["img_file_sub5"],
											),						
										);
				
										$res = $this->Additems->save($save,false);
										if(!$res){
											$this->Additems->rollback();
										}
										
										$url=$domain_item."content/save";
										$curl_params=array(
											"access_token"=>base64_encode($this->Loadbasic->load("img_service_secret").":".$this->Loadbasic->load("img_lisence_key")),
											"source"=>$post["Contents"]["img_file_source_sub5"],
											"filename"=>$post["Contents"]["img_file_sub5"],
										);
										
										$this->Curl->access($url,$curl_params);
								}
									
								$this->Contents->commit();
						
				}catch(Exception $e_){
						$this->Contents->rollback();
				}
				//exit;
				
				$this->Session->write("alert","コンテンツを１件設定しました。");
				$this->redirect(array("controller"=>"contents","action"=>"index"));
				
			}
		}
		else{
			if($id){

				$post=$this->Contents->find("first",array(
					"conditions"=>array(
						"Contents.id"=>$id,
					),
				));

				//jsonをエンコードしてセット
				$caption=json_decode(@$post["Contents"]["caption"],true);
				if(@$caption){
					$post["Contents"]=array_merge($post["Contents"],@$caption);
				}
				$shop_info=json_decode(@$post["Contents"]["shop_info"],true);
				if(@$shop_info){
					$post["Contents"]=array_merge($post["Contents"],@$shop_info);
				}	
				
		
				//各画像の初期配置
				$find_additem0=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$id,
						"Additems.type"=>0,
					),
				));				
				$find_additem1=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$id,
						"Additems.type"=>1,
					),
				));								
				$find_additem2=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$id,
						"Additems.type"=>2,
					),
				));					
				$find_additem3=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$id,
						"Additems.type"=>3,
					),
				));	
				$find_additem4=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$id,
						"Additems.type"=>4,
					),
				));	
				$find_additem5=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$id,
						"Additems.type"=>5,
					),
				));	


				if(@$find_additem0){
					$this->set("find_additem0",$find_additem0);					
					$post["Contents"]["img_file"] = $find_additem0["Additems"]["content"];					
				}			
				if(@$find_additem1){
					$this->set("find_additem1",$find_additem1);					
					$post["Contents"]["img_file_sub1"] = $find_additem1["Additems"]["content"];					
				}
				if(@$find_additem2){
					$this->set("find_additem2",$find_additem2);					
					$post["Contents"]["img_file_sub2"] = $find_additem2["Additems"]["content"];					
				}
				if(@$find_additem3){
					$this->set("find_additem3",$find_additem3);					
					$post["Contents"]["img_file_sub3"] = $find_additem3["Additems"]["content"];					
				}
				if(@$find_additem4){
					$this->set("find_additem4",$find_additem4);					
					$post["Contents"]["img_file_sub4"] = $find_additem4["Additems"]["content"];					
				}
				if(@$find_additem5){
					$this->set("find_additem5",$find_additem5);					
					$post["Contents"]["img_file_sub5"] = $find_additem5["Additems"]["content"];					
				}				
								
				$this->request->data=$post;
				
			}
		}
	}

	//★削除
	public function delete($id){
		
		$this->autoRender=false;

		//idでテーブルデータ削除
		$this->Contents->delete($id);
		$this->Additems->deleteAll(array('Additems.content_id' => $id));
		
		//テキスト表示とリダイレクト
		$this->Session->write("alert", "コンテンツを削除いたしました。");
		$this->redirect(array("controller"=>"contents","action"=>"index"));

	}
	
}
