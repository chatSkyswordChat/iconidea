const {__} = wp.i18n;
const apiFetch = wp.apiFetch;

document.addEventListener( 'DOMContentLoaded', function() {
	if ( elementorCommon ) {
		const sectionTmp = document.querySelector( '#tmpl-elementor-add-section' );

		if ( sectionTmp ) {
			const actionForAddSection = sectionTmp.innerHTML;

			if ( actionForAddSection ) {
				sectionTmp.innerHTML = actionForAddSection.replace( '<div class="elementor-add-section-drag-title', `<div class="elementor-add-section-area-button arrow-ekits-library-btn" style="margin-left: 5px; vertical-align: middle;" title="Arrow Elementor Kit"><img style="width: 40px" src="${ ArrowElementorLibrary.logo }" alt=""></div><div class="elementor-add-section-drag-title` );
			}
		}

		elementor.on( 'preview:loaded', function() {
			const editor = elementor.$previewContents[ 0 ].body;

			editor.addEventListener( 'click', async function( e ) {
				const arrowBtn = editor.querySelector( '.arrow-ekits-library-btn' );

				if ( arrowBtn.contains( e.target ) ) {
					const elementorModal = await elementorCommon.dialogsManager.createWidget( 'lightbox', {
						className: 'arrow-library-modal',
						closeButton: false,
						draggable: false,
						hide: {
							onOutsideClick: false,
							onEscKeyPress: false,
						},
					} );

					const widgetContent = elementorModal.getElements( 'widgetContent' );

					const headerHTML = `
					<div class="elementor-templates-modal__header">
						<div class="elementor-templates-modal__header__logo-area">
							<div class="elementor-templates-modal__header__logo">
								<img class="arrow-library-modal__header__logo" src="${ ArrowElementorLibrary.logo }" alt="Arrow Library">
								<span class="elementor-templates-modal__header__logo__title">
									Arrow Library
								</span>
							</div>
						</div>

						<div class="elementor-templates-modal__header__menu-area">
							<div id="elementor-template-library-header-menu">
								<div class="elementor-component-tab elementor-template-library-menu-item elementor-active" data-tab="pages">Pages</div>
								<div class="elementor-component-tab elementor-template-library-menu-item" data-tab="blocks">Blocks</div>
							</div>
						</div>
						<div class="elementor-templates-modal__header__items-area">
							<div class="elementor-templates-modal__header__close elementor-templates-modal__header__close--normal elementor-templates-modal__header__item">
								<i class="eicon-close" aria-hidden="true" title="Close"></i>
								<span class="elementor-screen-only">Close</span>
							</div>
						</div>
					</div>`;

					await widgetContent.find( '.dialog-header' ).html( headerHTML );

					await widgetContent.find( '.dialog-message' ).html(
						`<div class="arrow-library-modal__content">
							<div class="arrow-library-modal__content__templates">
								<div class="arrow-library-modal__content__container"></div>
							</div>
						</div>
						<div class="dialog-loading dialog-lightbox-loading">
							<div id="elementor-template-library-loading">
								<div class="elementor-loader-wrapper">
									<div class="elementor-loader">
										<div class="elementor-loader-boxes">
											<div class="elementor-loader-box"></div>
											<div class="elementor-loader-box"></div>
											<div class="elementor-loader-box"></div>
											<div class="elementor-loader-box"></div>
										</div>
									</div>
									<div class="elementor-loading-title">Loading</div>
								</div>
							</div>
						</div>`
					);

					await elementorModal.show();

					const eleLoading = widgetContent.find( '.dialog-lightbox-loading' );

					const getTemplates = await apiFetch( { path: 'arrow-ekit/get-templates' } );

					await eleLoading.hide();

					const CloseBtn = () => {
					// Click close button popup
						widgetContent.find( '.elementor-templates-modal__header__close' ).on( 'click', function() {
							elementorModal.hide();
						} );
					};

					// Click Tab button
					const MenuTabs = () => {
						widgetContent.find( '.elementor-template-library-menu-item' ).on( 'click', function() {
							widgetContent.find( '.elementor-template-library-menu-item' ).removeClass( 'elementor-active' );
							jQuery( this ).addClass( 'elementor-active' );

							renderTab( jQuery( this ).data( 'tab' ) );
						} );
					};

					const Filter = () => {
						widgetContent.find( '.arrow-library-modal__content__filter__item' ).on( 'click', function() {
							const tab = jQuery( this ).data( 'tab' );
							const filter = jQuery( this ).data( 'filter' );

							widgetContent.find( '.arrow-library-modal__content__filter__item' ).removeClass( 'arrow-library-modal__content__filter__item--active' );
							widgetContent.find( `.arrow-library-modal__content__filter__item[data-tab="${ filter }"]` ).addClass( 'arrow-library-modal__content__filter__item--active' );

							renderTab( tab, filter );
						} );
					};

					let modalContentTemplates = '';

					const renderTab = ( tab, filter = 'all' ) => {
						let html = '';

						const datas = [];
						let dataContent = {};

						widgetContent.find( '.arrow-library-modal__content__filter' ).remove();

						if ( tab === 'pages' ) {
							dataContent = {
								free: getTemplates?.free?.page,
								pro: getTemplates?.theme?.page,
							};
							widgetContent.find( '.arrow-library-modal__content__templates' ).prepend(
								`<div class="arrow-library-modal__content__filter">
									<div class="arrow-library-modal__content__filter__item ${ filter === 'all' ? 'arrow-library-modal__content__filter__item--active' : '' }" data-tab="${ tab }" data-filter="all">ALL</div>
									<div class="arrow-library-modal__content__filter__item ${ filter === 'free' ? 'arrow-library-modal__content__filter__item--active' : '' }" data-tab="${ tab }" data-filter="free">FREE</div>
									<div class="arrow-library-modal__content__filter__item ${ filter === 'pro' ? 'arrow-library-modal__content__filter__item--active' : '' }" data-tab="${ tab }" data-filter="pro">PRO</div>
								</div>`
							);
						} else if ( tab === 'blocks' ) {
							dataContent = {
								free: getTemplates?.free?.sections,
								pro: getTemplates?.theme?.sections,
							};
						}
						let freeTemp = [];
						let proTemp = [];
						if ( dataContent?.free ) {
							Object.entries( dataContent.free ).forEach( ( [ key, value ] ) => {
								freeTemp = [ ...freeTemp, { ...value, id: key, src: `https://arrowtheme.github.io/demo-data/${ ArrowElementorLibrary.theme }/arrow-kit/${ tab === 'pages' ? 'page' : 'templates' }/${ key }.jpg` } ];
							} );

							freeTemp.sort( function( a, b ) {
								return a.priority - b.priority;
							} );
						}
						if ( dataContent?.pro ) {
							Object.entries( dataContent.pro ).forEach( ( [ key, value ] ) => {
								proTemp = [ ...proTemp, { ...value, id: key, isPro: true, src: `https://arrowtheme.github.io/demo-data/${ ArrowElementorLibrary.theme }/arrow-kit/${ tab === 'pages' ? 'page' : 'templates' }/${ key }.jpg` } ];
							} );

							proTemp.sort( function( a, b ) {
								return a.priority - b.priority;
							} );
						}

						let renderTemp = '';
						if ( filter === 'pro' ) {
							renderTemp = proTemp;
						} else if ( filter === 'free' ) {
							renderTemp = freeTemp;
						} else {
							renderTemp = [ ...freeTemp, ...proTemp ];
						}

						renderTemp.length > 0 && renderTemp.forEach( ( page ) => {
							html += `
								<div class="arrow-library-modal__content__item ">
									<div class="arrow-library-modal__content__body content-body-${ tab }">
										${ page?.isPro ? '<div class="arrow-library-modal__content__pro">PRO</div>' : '' }
										<div class="arrow-library-modal__content__body__bg" style="background-image: url(${ page?.src || `https://arrowtheme.github.io/demo-data/arrow-kit-free/${ tab === 'pages' ? 'page' : 'templates' }/${ page.id }.jpg` });"></div>
										<div class="arrow-library-modal__content__preview" data-pro="${ page?.isPro ? 1 : 0 }" data-template-type="${ tab }" data-id="${ page.id }" data-url="${ page?.url || '' }" data-thumbnail="${ page?.thumbnail || '' }">
											<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
										</div>
									</div>
									<div class="arrow-library-modal__content__footer">
										<a class="arrow-library-modal__content__insert" data-pro="${ page?.isPro ? 1 : 0 }" data-template-type="${ tab }" data-id="${ page.id }">
											<i class="eicon-file-download"></i>
											INSERT
										</a>
										<div class="arrow-library-modal__content__name">${ page?.title || '' }</div>
									</div>
								</div>
							`;
						} );

						widgetContent.find( '.arrow-library-modal__content__container' ).html( html );

						const insertTemplate = () => {
							widgetContent.find( '.arrow-library-modal__content__insert' ).on( 'click', function( e ) {
								e.preventDefault();

								const templateType = jQuery( this ).data( 'template-type' );
								const id = jQuery( this ).data( 'id' );
								const isPro = jQuery( this ).data( 'pro' );

								const templateModel = new Backbone.Model( {
									getTitle() {
										return data.title;
									},
								} );

								let index = 0;
								const addSection = jQuery( editor ).find( '.arrow-ekits-library-btn' ).closest( '.elementor-add-section' );

								if ( addSection.hasClass( 'elementor-add-section-inline' ) ) {
									index = addSection.prevAll().length;
								} else {
									index = addSection.prev().children().length;
								}

								eleLoading.show();

								apiFetch( {
									path: 'arrow-ekit/import',
									method: 'POST',
									data: {
										type: templateType,
										id,
										postID: parseInt( ArrowElementorLibrary?.postID ) || 0,
										theme: isPro ? ArrowElementorLibrary.theme : '',
									},
								} ).then( function( data ) {
									if ( data?.success ) {
										const importData = () => {
											elementor.channels.data.trigger( 'template:before:insert', templateModel );
											elementor.getPreviewView().addChildModel( data.data, { at: index } || {} );
											elementor.channels.data.trigger( 'template:after:insert', {} );

											if ( undefined != $e && 'undefined' != typeof $e.internal ) {
												$e.internal( 'document/save/set-is-modified', { status: true } );
											} else {
												elementor.saver.setFlagEditorChange( true );
											}
										};

										if ( templateType === 'pages' ) {
											const confirm = elementorCommon.dialogsManager.createWidget( 'confirm', {
												id: 'elementor-clear-page-dialog',
												headerMessage: __( 'Delete All Content', 'arrow-elementor-kit' ),
												message: __( 'Attention: We are going to DELETE ALL CONTENT from this page. Are you sure you want to do that?', 'arrow-elementor-kit' ),
												position: {
													my: 'center center',
													at: 'center center',
												},
												strings: {
													confirm: __( 'Delete', 'arrow-elementor-kit' ),
													cancel: __( 'Cancel', 'arrow-elementor-kit' ),
												},
												onConfirm: () => {
													$e.run( 'document/elements/empty', { force: true } );
													importData();
													eleLoading.hide();
													elementorModal.hide();
												},
												onCancel: () => {
													importData();
													eleLoading.hide();
													elementorModal.hide();
												},
											} );

											confirm.show();
										} else {
											importData();

											eleLoading.hide();
											elementorModal.hide();
										}
									} else {
										elementorCommon.dialogsManager.createWidget( 'confirm', {
											id: 'elementor-clear-page-dialog',
											headerMessage: __( 'Import Arrow Library', 'arrow-elementor-kit' ),
											message: data?.message || __( 'Something went wrong. Please try again.', 'arrow-elementor-kit' ),
											position: {
												my: 'center center',
												at: 'center center',
											},
											strings: {
												confirm: __( 'OK', 'arrow-elementor-kit' ),
												cancel: __( 'Cancel', 'arrow-elementor-kit' ),
											},
											onConfirm: () => {
												eleLoading.hide();
											},
											onCancel: () => {
												eleLoading.hide();
											},
										} ).show();
									}
								} );
							} );
						};

						insertTemplate();

						const BacktoLibrary = () => {
							widgetContent.find( '.arrow-library-modal__back_library' ).on( 'click', function() {
								widgetContent.find( '.dialog-header' ).html( headerHTML );
								widgetContent.find( '.arrow-library-modal__content' ).html( modalContentTemplates );
								widgetContent.find( '.dialog-message' ).removeClass( 'arrow-library-modal__is_iframe' );
								widgetContent.find( '.elementor-template-library-menu-item' ).removeClass( 'elementor-active' );
								widgetContent.find( `.elementor-template-library-menu-item[data-tab="${ tab }"]` ).addClass( 'elementor-active' );

								insertTemplate();
								CloseBtn();
								MenuTabs();
								Preview();
								Filter();
							} );
						};

						const Preview = () => {
							widgetContent.find( '.arrow-library-modal__content__preview' ).on( 'click', function() {
								const url = jQuery( this ).attr( 'data-url' );
								const thumbnail = jQuery( this ).attr( 'data-thumbnail' );
								const tab = jQuery( this ).data( 'template-type' );
								const id = jQuery( this ).data( 'id' );
								const pro = jQuery( this ).data( 'pro' );

								modalContentTemplates = widgetContent.find( '.arrow-library-modal__content' ).html();

								if ( url || thumbnail ) {
									widgetContent.find( '.dialog-message' ).addClass( 'arrow-library-modal__is_iframe' );
									widgetContent.find( '.elementor-templates-modal__header__logo-area' ).html( `<a class="arrow-library-modal__back_library"><i class="eicon-chevron-left"></i>Back to Library</a>` );
									widgetContent.find( '#elementor-template-library-header-menu' ).html( '' );
									widgetContent.find( '.elementor-templates-modal__header__items-area' ).append( `<a class="arrow-library-modal__content__insert" data-pro="${ pro ? 1 : 0 }" data-template-type="${ tab }" data-id="${ id }" style="display: block; margin-right: 10px; font-size: 12px;"><i class="eicon-file-download"></i>INSERT</a>` );
								}

								if ( url ) {
									widgetContent.find( '.arrow-library-modal__content' ).html( `<iframe src="${ url }"></iframe>` );
								} else if ( thumbnail ) {
									widgetContent.find( '.arrow-library-modal__content' ).html( `<img src="${ thumbnail }">` );
								}

								insertTemplate();
								BacktoLibrary();
								CloseBtn();
								MenuTabs();
							} );
						};

						Preview();
						Filter();
					};

					renderTab( 'pages' );
					CloseBtn();
					MenuTabs();
					Filter();
				}
			} );
		} );
	}
} );
