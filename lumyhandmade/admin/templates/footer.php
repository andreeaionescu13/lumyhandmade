</body>

<script>
    $(document).ready(function(){
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        let open_form = window.location.hash;
        $(open_form).click();

        $('.remove-order-item a').click(function(event) {
           	event.preventDefault();

           	$(this).closest('.order-product').remove();
		});

        let order_item_template = $('#order-product-template');
        $('.order-add-item').click(function(event) {
            event.preventDefault();

           	let $products_wrapper = $(this).closest('.form-group').find('.products-table');
           	let products_count = $products_wrapper.find('.order-product').length;
           	let new_product_index = products_count + 1;

           	$(order_item_template).find('.product-qty').attr('name', 'products[' + new_product_index + '][qty]');
           	$(order_item_template).find('.product-select').attr('name', 'products[' + new_product_index + '][product_id]');
            $(order_item_template).find('label').html('Product ' + new_product_index);

            $products_wrapper.append(order_item_template.html());

           	console.log($(order_item_template));
		});

        // // Select/Deselect checkboxes
        // var checkbox = $('table tbody input[type="checkbox"]');
        // $("#selectAll").click(function(){
        //     if(this.checked){
        //         checkbox.each(function(){
        //             this.checked = true;
        //         });
        //     } else{
        //         checkbox.each(function(){
        //             this.checked = false;
        //         });
        //     }
        // });
        // checkbox.click(function(){
        //     if(!this.checked){
        //         $("#selectAll").prop("checked", false);
        //     }
        // });
    });
</script>

</html>