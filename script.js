$('#ward_type').on('change', function(){
                                                var data = $('#ward_type').val();
                                                $.post('<?php echo base_url();?>ward/check_avaliabilty', { id: data },
                                                  function(result){
                                                    // console.log(result);
                                                    if(result == 'not_available'){
                                                        $('#feedbackcheck').html('<span class="text text-danger" style="padding-left:15%;"><i class="fa fa-fw ti-close"></i> <ul style="padding-left: 20.5% ;margin-top: -5.5%;"> <li> This ward is fully occupy... </li></ul> </span>');
                                                        $('#btnBedAssign').addClass('hidden');
                                                    }else if(result == 'available'){
                                                       $('#feedbackcheck').html('<p class="text text-success">There is still more space...</p>');
                                                       $('#btnBedAssign').removeClass('hidden');
                                                    }else{
                                                        $('#feedbackcheck').html(' ');
                                                        $('#btnBedAssign').removeClass('hidden');
                                                    }
                                                    
                                                });
                                            });
<script type="text/javascript">
                                           $('#eachDiscount_<?php echo $b[3]; ?>').keyup(function(){
                                                var each_discount = '';
                                                var finalTotal = $('#finalTotal');
                                                var each_medicine_total = $('#each_medicine_total_<?php echo $b[3]; ?>');
                                                each_discount =  $.trim($(this).val());
                                                if(each_discount == null){
                                                    each_discount = 0;
                                                }

                                                var each_total = $('#eachTotal_<?php echo $b[3]; ?>').val();
                                                var dt = $('#dT_<?php echo $b[3]; ?>');
                                                var eachMedicineTotal = each_total - each_discount;
                                                    each_medicine_total.text(eachMedicineTotal);
                                                    dt.val(eachMedicineTotal);

                                           });
                                       </script>