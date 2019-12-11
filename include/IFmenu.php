<?php 
	if(!isset($_GET["page"]) || $_GET["page"]=='homepage'){
		include 'include/homepage.php';
	}else{
		if($_GET["page"]=='viewRepairs'){
			include 'include/Repair/view.php';
		}else{
			if($_GET["page"]=='newRepair'){
				include 'include/Repair/new.php';
			}else{
				if($_GET["page"]=='updateRepair'){
					include 'include/Repair/update.php';
				}else{
					if($_GET["page"]=='deleteRepair'){
						include 'include/Repair/delete.php';
					}else{
						if($_GET["page"]=='viewCustomers'){
							include 'include/Customer/view.php';
						}else{
							if($_GET["page"]=='newCustomer'){
								include 'include/Customer/new.php';
							}else{
								if($_GET["page"]=='updateCustomer'){
									include 'include/Customer/update.php';
								}else{
									if($_GET["page"]=='deleteCustomer'){
										include 'include/Customer/delete.php';
									}else{
										if($_GET["page"]=='viewOrders'){
											include 'include/Order/view.php';
										}else{
											if($_GET["page"]=='newOrder'){
												include 'include/Order/new.php';
											}else{
												if($_GET["page"]=='updateOrder'){
													include 'include/Order/update.php';
												}else{
													if($_GET["page"]=='deleteOrder'){
														include 'include/Order/delete.php';
													}else{
														if($_GET["page"]=='viewFornit'){
															include 'include/Fornit/view.php';
														}else{
															if($_GET["page"]=='newFornit'){
																include 'include/Fornit/new.php';
															}else{
																if($_GET["page"]=='updateFornit'){
																	include 'include/Fornit/update.php';
																}else{
																	if($_GET["page"]=='deleteFornit'){
																		include 'include/Fornit/delete.php';
																	}else{
																		if($_GET["page"]=='viewStock'){
																			include 'include/Stock/view.php';
																		}else{
																			if($_GET["page"]=='newStock'){
																				include 'include/Stock/new.php';
																			}else{
																				if($_GET["page"]=='updateStock'){
																					include 'include/Stock/update.php';
																				}else{
																					if($_GET["page"]=='deleteStock'){
																						include 'include/Stock/delete.php';
																					}else{
																						if($_GET["page"]=='viewWorkers'){
																							include 'include/Worker/view.php';
																						}else{
																							if($_GET["page"]=='newWorker'){
																								include 'include/Worker/new.php';
																							}else{
																								if($_GET["page"]=='updateWorker'){
																									include 'include/Worker/update.php';
																								}else{
																									if($_GET["page"]=='deleteWorker'){
																										include 'include/Worker/delete.php';
																									}else{
																										if($_GET["page"]=='querySQL'){
																											include 'include/querySQL.php';
																										}else{
																											if($_GET["page"]=='esegui'){
																												include 'include/esegui.php';
																											}else{
																												if($_GET["page"]=='prospMensile'){
																													include 'include/prospetto.php';
																												}else{
																													echo "<p align=\"center\" style=\"font-size: 16pt;\"><br><br>ERRORE! Pagina non trovata.</p>";
																												}
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
?>