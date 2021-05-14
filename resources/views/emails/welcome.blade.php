<div style="background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
	<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#edf2f7;margin:0;padding:0;width:100%">
		<tbody><tr>
			<td align="center">
				<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin:0;padding:0;width:100%">
					<tbody><tr>
						<td style="padding:25px 0;text-align:center">
							<a href="{{ url('/') }}" style="display:inline-block" target="_blank">
								<img src="{{ asset('img/logo.png') }}" width="160" alt="" class="CToWUd"/>
							</a>
						</td>
					</tr>

					<tr>
						<td width="100%" cellpadding="0" cellspacing="0" style="background-color:#edf2f7;margin:0;padding:0;width:100%">
							<table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#ffffff;border-color:#e8e5ef;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px">
								
								<tbody><tr>
									<td style="max-width:100vw;padding:32px">
										<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
											<tbody><tr>
												<td>
                                                    <p style="font-size:14px">
                                                        Thanks you {{ $user->first_name }} for joining <strong>{{ config('app.name') }}</strong>!
													</p>

                                                    <p style="font-size:14px">
                                                        Please review our <a href="{{ url('/guide') }}" target="_blank">getting started guide</a> to ensure that your account is set up correctly.
                                                    </p>

                                                    {{-- <p style="font-size:14px">
                                                        Have any questions? Visit <a href="https://socialsnowball.zendesk.com/hc/en-us" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://socialsnowball.zendesk.com/hc/en-us&amp;source=gmail&amp;ust=1621002115819000&amp;usg=AFQjCNFhcMSOtCKVassVvDsz0RyIIqAzKA">{{ config('app.name') }} Support</a> or <a href="https://socialsnowball.zendesk.com/hc/en-us/requests/new" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://socialsnowball.zendesk.com/hc/en-us/requests/new&amp;source=gmail&amp;ust=1621002115819000&amp;usg=AFQjCNG0SUkUJdtsOToaxz4Du29oXex5vg">contact us</a>.
                                                    </p> --}}

													<p style="font-size:14px">Best,<br><a href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a></p>
												</td>
											</tr>
											<tr>
												<td>
													<table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="margin:0 auto;padding:0;text-align:center;width:570px">
														<tbody><tr>
															<td align="center">
																<p style="color:#b0adc5;font-size:12px;font-family:'Roboto',sans-serif;text-align:center">
																	&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
															</td>
														</tr>
													</tbody></table>
												</td>
											</tr>
										</tbody></table>
									</td>
								</tr>
							</tbody></table>
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
	</tbody></table>
</div>