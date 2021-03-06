<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
            <div id="content">
                <h1>Console</h1>
                <div name="sell_parts">
                    <h3>List of all robots</h3>
                    <div class="large_scrollbar">
                       <table id="robots_table" class="table table-hover">
                          <tr>
                             <th></th>
                             <th>Robot Top</th>
                             <th>Robot Torso</th>
                             <th>Robot Bottom</th>
                          </tr>
                          {robots}
                          <tr>
                             <td><input name="robots_check" type="checkbox" /></td>
                             <td>{top}</td>
                             <td>{torso}</td>
                             <td>{bottom}</td>
                          </tr>
                          {/robots}
                       </table>
                    </div>
                    <button>Sell Selected</button><button id="robots_select">Select All</button>
                </div>
                
                <div name="PCR_registration">
                    <h3>PCR Registration</h3>
                    <table>
                        <tr>
                            <td>Plant Name:</td>
                        </tr>
                        <tr>
                            <td><input type="texr" id="plant_name" required></td>
                        </tr>
                        <tr>
                            <td>Secret Token:</td>
                        </tr>
                        <tr>
                            <td><input type="texr" id="secret_token" required></td>
                        </tr>
                        <tr>
                            <td><button id="btn_register">Register</button></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h3>DANGER ZONE</h3>
                    <button id="btn_reboot">Reboot</button>
                </div>
            </div>
            <script>
            $(document).ready(function(){
                   // Select all toggle
                   $('#robots_select').click(function(){
                       var checkbox = $('input[name=robots_check]');
                       checkbox.prop('checked',!checkbox.prop('checked'));
                   });
                
                
                
                //var newURL = window.location.protocol + "//" + window.location.host;
                
                //reboots factory
                $('#btn_reboot').click(function(){
                var msg = "WARNING: Rebooting the plant causes everything to be reset. " +
                        "Are you sure you want to do this?.";
                    if (confirm(msg) == true){
                        $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url(); ?>' + 'Manage/Reboot',
                                //dataType: 'JSON',
                                success:function(response){
                                    //console.log(response);
                                    if(response == 1){
                                        alert('Plant Reset');
                                    }
                                    else{
                                        alert('ERROR: Could not reboot plant');
                                    }
                                    location.reload();
                                },
                                error:function(){
                                    alert('ERROR: Server could not process your request');
                                    location.reload();
                                }
                        });
                    }
                });
                
                //registers factory
                $('#btn_register').click(function(){
                    var pName = $('#plant_name').val();
                    var sToken = $('#secret_token').val();
                    if (pName != null && pName != "" && sToken != null && sToken != ""){
                        //console.log(pName+sToken);
                        $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url(); ?>' + 'Manage/Register',
                                dataType: 'JSON',
                                data:{pName: pName, sToken: sToken},
                                success:function(response){
                                    //alert(response);
                                    if (response==1){
                                        alert('Plant Registerd');
                                    }
                                    else{
                                        alert('Invalid factory name or token given');
                                    }
                                    location.reload();
                                },
                                error:function(){
                                    alert('ERROR: Server could not process your request');
                                    location.reload();
                                }
                        });
                    }
                });
            });

            </script>
            <!--end content-->
        </div>
    </section>
</section>

