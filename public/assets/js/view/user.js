//globals
$(function(){

	var UserView = Backbone.View.extend({
		el:'.userPage',
		events:{
			'click .js-controlAdd':'setDataToTable',
			'change .js-rate':'changeSetData',
			'change .js-comment':'changeSetData',
			'change .js-part':'changeSetData',
			'submit [name="guitar"]':'postData',
			'submit [name="drum"]':'postData',
		},
		initialize:function(){
			// 飽くまでEventsの管理くらいにbackboneを使っている為、Model/Collectionなどを設定していない。
			var self = this;
			var hotJsonFiles = ['musics_hot.json'];
			var oldJsonFiles = ['musics_old_muji.json','musics_old_gitadora.json','musics_old_v.json','musics_old_xg.json'];
			self.hotMusicData = [];
			self.oldMusicData = [];

			$.when(
				$.getJSON(PAGEDATA.root+'musicdata/current/'+hotJsonFiles[0]),
				$.getJSON(PAGEDATA.root+'musicdata/current/'+oldJsonFiles[0]),
				$.getJSON(PAGEDATA.root+'musicdata/current/'+oldJsonFiles[1]),
				$.getJSON(PAGEDATA.root+'musicdata/current/'+oldJsonFiles[2]),
				$.getJSON(PAGEDATA.root+'musicdata/current/'+oldJsonFiles[3])
			).done(function(data,data1,data2,data3,data4){
				data[0].shift();
				data1[0].shift();
				data2[0].shift();
				data3[0].shift();
				data4[0].shift();

				self.hotMusicData = data[0];
				self.oldMusicData = data1[0].concat(data2[0],data3[0],data4[0]);
				self.setSelectForm('hot');
				self.setSelectForm('old');
				console.log(self.hotMusicData);
			});


		},
		setSelectForm:function(flg){
			// var musicTitles = $.extend(true,[],this.hotMusicData);
			var musicTitles = [];
			var selectDom,data;
			if(flg == 'hot'){
				selectDom = $('.drumContent select.hotSelect,.guitarContent select.hotSelect');
				data = this.hotMusicData;
			}else{
				selectDom = $('.drumContent select.oldSelect,.guitarContent select.oldSelect');
				data = this.oldMusicData;
			}
			$.each(data,function(i,val){
				if(val == 'musics') return true;
				if(musicTitles.indexOf(val.title) == -1){
					musicTitles.push(val.title)
				}
			})
			var node = '';
			function strSortFunc(a, b) {
				//個別例外処理
				a = strUniqStrs(a);
				b = strUniqStrs(b);

				var titleA = a.toLowerCase();
				var titleB = b.toLowerCase();
				if (titleA < titleB) {return -1}
				if (titleA > titleB) {return 1}
				return 0;
			}
			function strUniqStrs(str){
				if(str =="†渚の小悪魔ラヴリィ～レイディオ† (GITADORA ver.)"){
					str='渚の小悪魔ラヴリィ～レイディオ';
				}else if(str=='☆shining☆(GF&dm style)'){
					str='shining';
				}else if(str=='αρχη'){
					str='apxn';
				}
				return str;
			}
			musicTitles.sort(strSortFunc);
			$.each(musicTitles,function(i,v){
				node += '<option value="'+musicTitles[i]+'">'+musicTitles[i]+'</option>'
			})
			selectDom.append(node);
		},
		setDataToTable:function(e){
			var view = this;
			var elem = $(e.target);
			var wrap = elem.closest('.tabContent');
			var partType = (!wrap.hasClass('drumContent')) ? 'guitarfreaks':'drummania';
			var hotTable = wrap.find('.hotControl table tbody');
			var oldTable = wrap.find('.oldControl table tbody');
			var hotSelectElem = elem.closest('.userform').find('.hotSelect');
			var oldSelectElem = elem.closest('.userform').find('.oldSelect');

			var hotSelect,oldSelect,hotData,oldData,node,tmp,tmpb;

			//選択した曲を配列[str]で取得
			hotSelect = hotSelectElem.val();
			oldSelect = oldSelectElem.val();

			//既にユーザー情報追加されていないかをDOMベースにチェック

			hotData = [];
			oldData = [];


			//既存分をデータ化
			function getTypeData(type){
				var mid;
				var targetTable,targetMusicData,targetData;
				if(type=='hot'){
					targetTable = hotTable;
					targetMusicData = view.hotMusicData;
					targetData = hotData;
				}else{
					targetTable = oldTable;
					targetMusicData = view.oldMusicData;
					targetData = oldData;
				}

				if(targetTable.find('tr').length == 0) return targetData;

				targetTable.find('tr').each(function(i){

					var inputData = $(this).find('input[type=hidden]')
					mid = inputData.attr('data-mid');
					tmp = {};

					tmp = _.find(targetMusicData,function(obj){

						if(obj.id == mid){
							return true;
						}
					})

					tmp['rate'] = inputData.attr('data-rate');
					tmp['skill'] = inputData.attr('data-skill');
					tmp['rank'] = inputData.attr('data-rank');
					tmp['option'] = inputData.attr('data-option');
					tmp['comment'] = inputData.attr('data-comment');
					targetData.push(tmp)
				})
				return targetData;
			}

			hotData = getTypeData('hot');
			oldData = getTypeData('old');

			//新規追加分をデータ化
			function addTypeData(type){
				var checkData;
				var targetTable,targetMusicData,targetData,targetSelect;
				if(type=='hot'){
					targetTable = hotTable;
					targetMusicData = view.hotMusicData;
					targetData = hotData;
					targetSelect = hotSelect;
				}else{
					targetTable = oldTable;
					targetMusicData = view.oldMusicData;
					targetData = oldData;
					targetSelect = oldSelect;
				}
				if(!targetSelect) return targetData;
				$.each(targetSelect,function(i,val){
					//重複分整理
					checkData = null;
					checkData = _.find(targetData,function(obj){
						if(obj.title == val) return true;
					})

					if(checkData != null) return true;

					tmpb = (partType == 'drummania') ? 'BSC-D' : 'BSC-G';
					tmp = _.detect(targetMusicData,function(obj){
						if(obj.title == val && obj.part==tmpb) return true;
					})

					tmp['rate'] = 0;
					tmp['skill'] = 0;
					tmp['rank'] = 'C';
					tmp['option'] = null;
					tmp['comment'] = '';
					targetData.push(tmp);
				})
				return targetData;
			}

			hotData = addTypeData('hot');


			oldData = addTypeData('old');



			function setTemplate(type){
				var targetData = (type == 'hot') ? hotData : oldData;
				var targetTable = (type == 'hot') ? hotTable : oldTable;


				node = ''
				if(targetData.length == 0) return node;
				$.each(targetData,function(i,val){
					node += templateTable(i,val)
				})
				targetTable.html(node);
			}

			setTemplate('hot');
			setTemplate('old');

			function templateTable(i,data){
				var node ='';
				var option = '';

				if(data.part.slice(-1) == 'D'){
					option+= '<option value="BSC-D">BSC-D</option>';
					option+= '<option value="ADV-D">ADV-D</option>';
					option+= '<option value="EXT-D">EXT-D</option>';
					option+= '<option value="MAS-D">MAS-D</option>';
				}else{
					option+= '<option value="BSC-G">BSC-G</option>';
					option+= '<option value="ADV-G">ADV-G</option>';
					option+= '<option value="EXT-G">EXT-G</option>';
					option+= '<option value="MAS-G">MAS-G</option>';
					option+= '<option value="BSC-B">BSC-B</option>';
					option+= '<option value="ADV-B">ADV-B</option>';
					option+= '<option value="EXT-B">EXT-B</option>';
					option+= '<option value="MAS-B">MAS-B</option>';
				}
				node+='<tr>\n';
				node+='<td class="celNum">'+(i+1)+'</td>\n';
				node+='<td class="celTitle">'+data.title+'</td>\n';
				node+='<td class="celPart"><select class="js-part">'
				node+=option
				node+='</select></td>\n'
				node+='<td class="celLv">'+data.lv+'</td>\n';
				node+='<td class="celRate"><input type="number" max="100" min="0" step="0.01" class="js-rate" value="'+data.rate+'" /></td>\n';
				node+='<td class="celSkillPoint">'+data.skill+'</td>\n';
				node+='<td class="celRank">'+data.rank+'</td>\n';
				node+='<td class="celComment"><textarea class="js-comment">'+data.comment+'</textarea></td>\n';
				node+='<td class="celDelete"><span class="submitBase inverse js-celDelete">削除</span></td>\n';
				node+='<td class="hide"> <input type="hidden" data-mid='+data.id+' data-title="'+data.title+'" data-part="'+data.part+'" data-rate="'+data.rate+'" data-skill="'+data.skill+'" data-rank="'+data.rank+'" data-lv="'+data.lv+'" data-comment="'+data.comment+'" /> </td>\n';
				node+='</tr>\n';

				return node;
			}
		},
		changeSetData:function(e){
			var view = this;
			var $target = $(e.target);
			var $tr = $target.closest('tr');
			var $hidden = $tr.find('input[type="hidden"]');

			var partType = 'drummania'
			if($target.closest('.tabContent').hasClass('guitarContent')){
				partType = 'guitarfreaks'
			}

			var musicData = view.hotMusicData;
			if($target.closest('table').hasClass('old')){
				musicData = view.oldMusicData;
			}
			
			var tmp;
			console.log('changed')
			if($target.hasClass('js-part')){
				tmp = _.find(musicData,function(obj){
					if(obj.title == $hidden.attr('data-title') && obj.part == $target.val()) return true;
				})
				console.log(tmp)
				if(tmp.lv == '-'){
					alert('この難易度は存在しません。')
					$target.val($hidden.attr('data-part'));
					return true;
				}
				$hidden.attr('data-part',tmp.part);
				$hidden.attr('data-mid',tmp.id);
				$hidden.attr('data-lv',tmp.lv);
				$hidden.attr('data-skill',view.mathSkillPoint(tmp.lv,$hidden.attr('data-rate')) );

				//DOM
				$tr.find('.celLv').text($hidden.attr('data-lv'))
				$tr.find('.celSkillPoint').text($hidden.attr('data-skill'))
			}
			if($target.hasClass('js-comment')){
				$hidden.attr('data-comment',$target.val());
				$tr.find('.celComment textarea').text($hidden.attr('data-comment'))
			}
			if($target.hasClass('js-rate')){
				tmp = $target.val();
				if(tmp > 100){
					alert('数値が不正です。');
					$target.val($hidden.attr('data-rate'));
					return true;
				}
				if(tmp.indexOf('.') != -1){
					tmp = tmp*1
					tmp = tmp.toFixed(2)
				}else{
					tmp = tmp*1
					tmp = tmp.toFixed(2)
				}
				$hidden.attr('data-rate',tmp);
				$hidden.attr('data-skill',view.mathSkillPoint( $hidden.attr('data-lv') , parseInt($hidden.attr('data-rate')) ));
				
				$tr.find('.celRate input').val($hidden.attr('data-rate'));
				$tr.find('.celRank').text(view.getRank( parseInt($hidden.attr('data-rate')) ));
				$tr.find('.celSkillPoint').text($hidden.attr('data-skill'));
			}
		},
		getRank:function(int){
			if(int*1 < 63 ){
				return 'C'
			}else if(int*1 < 73){
				return 'B'
			}else if(int*1 < 80){
				return 'A'
			}else if(int*1 < 95){
				return 'S'
			}else if(int*1 < 100){
				return 'SS'
			}else if(int*1 == 100){
				return 'EXC'
			}
		},
		mathSkillPoint:function(lv,rate){
			var tmp = {
				lv: lv*100,
				rate: rate*100
			}
			if(parseInt(rate) == 100){
				return (tmp.lv/10) * 2
			}
			return (( ( tmp.lv * 2 ) * tmp.rate ) / 100000).toFixed(2)
		},
		postData:function(e){
			var $target = $(e.target);
			var view = this;
			var hot = [];
			var old = [];

			$target.find('.hotControl tbody tr').each(function(i){
				var elem = $(this).find('input[type="hidden"]');
				hot[i] = {
					id:elem.attr('data-mid'),
					rate:elem.attr('data-rate'),
					skill:elem.attr('data-skill'),
					comment:elem.attr('data-comment'),
				}
			})
			$target.find('.oldControl tbody tr').each(function(i){
				var elem = $(this).find('input[type="hidden"]');
				old[i] = {
					id:elem.attr('data-mid'),
					rate:elem.attr('data-rate'),
					skill:elem.attr('data-skill'),
					comment:elem.attr('data-comment'),
				}
			})
			$.post('http://gitadora.96.lt/fuel/public/user',{hot:hot,old:old},function(data){
				console.log(data)
				alert(0)
			},'json')
		}
	})
	var userView = new UserView();
})