$(document).ready(function() {

	/*
	 * Masks
	 */
	$('.date').mask('00/00/0000', {placeholder: "__/__/____"});
	$('.dateDDMM').mask('00/00', {placeholder: "__/__"});
	$('.number').mask('00000000000');
	$(".phoneNumber").mask("(00)-0000-00000");
	$('.money').priceFormat({prefix: '', centsSeparator: ',', thousandsSeparator: '.'});
	// End Maks =====

	jQuery('.date').datetimepicker({
		timepicker	: false,
		format 		:'d/m/Y',
		lang 		: lang.datepickerLang
	});

	jQuery('.dateDDMM').datetimepicker({
		timepicker	: false,
		format 		:'d/m',
		lang 		: lang.datepickerLang
	});

	$('.no-zero').blur(function() {
		if ($(this).val() == '0,00') {
			$(this).val('');
		}
	});

	/*
	 * Inputs/Outputs
	 */
	$('.inputs-outputs-products').change(function() {
		var _this = $(this);
		_this.prop('disabled', true);
		var productId = _this.val();
		// Verifica se foi selecionado algum produto
		if (productId != '') {
			$('#navbar-wrap').hide();
			NProgress.start();
			var interval = setInterval(function() { NProgress.inc(); }, 1000);
			// Realiza a requisição ajax via POST
			$.post( '../stocks/get_product', { productId : productId } , function(html) {
				$('#product-details').html(html);
			}).done(function() {
				$('.details').slideDown(300);
				$('#product-add').slideDown(300);
				$('#product-details').slideDown(300);
				_this.prop('disabled', false);
				$('#product-details').fadeTo('slow', 1);
				clearInterval(interval);
				NProgress.done();
				$('#navbar-wrap').show();
			}).fail(function() {
				_this.prop('disabled', false);
				clearInterval(interval);
				NProgress.done();
				$('#navbar-wrap').show();
			});
		// Se não houver produto selecionado, esconde a div de detalhes
		} else {
			$('.details').slideUp(300);
			$('#product-add').slideUp(300);
			_this.prop('disabled', false);
		}
	});

	$('.inputs-outputs-products').trigger('change');

	function deleteProduct() {
		$('.product-delete').click(function() {
			$('#navbar-wrap').hide();
			NProgress.start();
			var interval = setInterval(function() { NProgress.inc(); }, 1000);

			var _this = $(this);
			_this.prop('disabled', true);
			var question = $(this).attr('confirm-text');
			var key = $(this).attr('id');
			if (confirm(question)) { 
				$.post( '../stocks/delete_product', { 
					key	: key,
				} , function(html) {
					$('#line-'+key).remove();
					if (html != '') {
						$('#product-list').html(html);
					}
				}).done(function() {
					_this.prop('disabled', false);
					$('#product-details').fadeTo('slow', 1);
					clearInterval(interval);
					NProgress.done();
					$('#navbar-wrap').show();
				}).fail(function() {
					_this.prop('disabled', false);
					clearInterval(interval);
					NProgress.done();
					$('#navbar-wrap').show();
				});
				return true; 
			} else {
				clearInterval(interval);
				NProgress.done();
				$('#navbar-wrap').show();
			}
			return false;
		});
	}
	deleteProduct();

	function showAlert(controller, model, type, message) {
		var _this = $(this);
		_this.prop('disabled', false);
		$.post( '../'+controller+'/show_alert', { 
			type 	: type,
			model 	: model,
			message	: message,
		} , function() {
			$('#siFlashMessage').remove();
		}).done(function(html) {
			$('#content').prepend(html);
		}).fail(function() {
			alert('Error!');
		});
		return false;
	}
	// End Inputs/Outputs =====
	
	/*
	 * Profit
	 */
	$('#purchase-value, #sell-value').keyup(function() {
		// Armazena o valor de compra e retira as vírgulas
		var purchaseValue = $('#purchase-value').val();
		purchaseValue = purchaseValue.replace('.', '');
		purchaseValue = purchaseValue.replace(',', '.');

		// Armazena o valor de venda e retira as vírgulas
		var sellValue = $('#sell-value').val();
		sellValue = sellValue.replace('.', '');
		sellValue = sellValue.replace(',', '.');

		// Cálcula o valor total, transformando em float
		var total = parseFloat(sellValue).toFixed(2) - parseFloat(purchaseValue).toFixed(2);

		// Define a quantidade de casas decimais
		$('#profit').val(total.toFixed(2));
		// Atualiza o campo de lucro
		$('#profit').priceFormat({prefix: '', centsSeparator: ',', thousandsSeparator: '.', allowNegative: true});

	});

	$('#purchase-value, #sell-value').trigger('keyup');
	// End Profit =====

	/**
	* Capitalize only the first letter.
	*/
    $('.upperFirstLetter').on('blur keypress', function(event) {
        var $this = $(this),
        val = $this.val();
        val = val.substr(0, 1).toUpperCase() + val.substr(1);
        $this.val(val);
    });

    //Import Dialog
    var dialog = $( "#import-dialog" ).dialog({
      autoOpen: false,
      height: 400,
      width: 650,
      modal: true,
      draggable: false,
	buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });

    $( "#import_btn" ).button().on( "click", function() {
		dialog.dialog( "open" );
	});

	//end import dialog

	$('.notification.unread').click(function() {
		$.post('http://' + window.location.hostname + '/admin/businesses/removeNotificationAlert', 
		function(data) {
			if (data === '200') {
				$('.notification').removeClass('unread');
			}
		}).done(function(html) {
			
		}).fail(function() {
			
		});
	});

});