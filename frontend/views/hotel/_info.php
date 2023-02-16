            <div class="catCard__data">
                <div class="tour-card__meta-item" tabindex="0">
                <!--<svg xmlns="http://www.w3.org/2000/svg" width="17" height="12" viewBox="0 0 17 12" aria-labelledby="plane-departure" fill="#000000" role="presentation" class="icon icon-plane-departure">
                    <title id="plane-departure" lang="en">plane-departure icon</title>
                    <path d="m15.8385 10.3847h-14.73176c-.214191 0-.387677.1785-.387677.3988v.7975c0 .2203.173486.3988.387677.3988h14.73176c.2142 0 .3877-.1785.3877-.3988v-.7975c0-.2203-.1735-.3988-.3877-.3988zm-13.16772-2.65989c.15216.17047.36587.26717.58951.26692l3.16296-.00449c.24962-.00034.49564-.06113.71817-.17744l7.04988-3.67975c.6479-.3382 1.2287-.82094 1.6239-1.45321.4437-.70978.4919-1.22343.3167-1.5863-.1747-.363111-.5994-.629778-1.4114-.684108-.7232-.048349-1.4426.147539-2.0905.485483l-2.3869 1.245855-5.29908-2.0451076c-.12974-.08989972-.29664-.10048587-.43614-.0276636l-1.59311.8316512c-.25853.13483-.32104.48972-.12527.71103l3.78519 2.44486-2.50076 1.30542-1.75303-.90891c-.12249-.06352-.26704-.06333-.38938.0005l-.972339.50766c-.25296.13209-.319592.47651-.13496.69981z" ></path>
                </svg>--><span class="capitalize"><?=Yii::$app->formatter->asDate($model->HotelCheckInDate, 'php:d M Y');?></span>
            </div>
            <div class="tour-card__meta-item" tabindex="0">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" aria-labelledby="nights" fill="#000000" role="presentation" class="icon icon-nights">
                    <title id="nights" lang="en">nights icon</title>
                    <g>
                        <filter id="a">
                            <feColorMatrix in="SourceGraphic" type="matrix" values="0 0 0 0 0.031373 0 0 0 0 0.725490 0 0 0 0 0.709804 0 0 0 1.000000 0"></feColorMatrix>
                        </filter>
                        <mask id="b" fill="#fff">
                            <path d="m0 0h64v64h-64z" fill="#fff" fill-rule="evenodd"></path>
                        </mask>
                        <path d="m11.9037686 9.40766667c-.1151867-.143-.3094567-.19586667-.4787983-.1352-.4770791.17246666-.9945595.26086666-1.5395472.26086666-2.60717289 0-4.72781105-2.13893333-4.72781105-4.76666666 0-1.58166667.77450141-3.05413334 2.07164084-3.93986667.14699195-.10053333.21747931-.28166667.17793762-.45586667s-.18137603-.30593333-.35759444-.33193333c-.20114687-.02946667-.40143414-.039-.60258101-.039-3.5553139 0-6.44701506 2.91546667-6.44701506 6.5 0 3.5845333 2.89170116 6.5 6.44701506 6.5 2.25645528 0 4.30918484-1.1561333 5.48941844-3.09226667.0954158-.15686666.0825218-.35706666-.0326649-.50006666z"></path>
                        <path d="m13.5 2.5c-1.103 0-2-.897-2-2 0-.276-.224-.5-.5-.5s-.5.224-.5.5c0 1.103-.897 2-2 2-.276 0-.5.224-.5.5s.224.5.5.5c1.103 0 2 .897 2 2 0 .276.224.5.5.5s.5-.224.5-.5c0-1.103.897-2 2-2 .276 0 .5-.224.5-.5s-.224-.5-.5-.5z"></path>
                    </g>
                </svg>
                <span><?=$model->HotelNight?></span>
            </div>
            <div class="tour-card__meta-item" tabindex="0">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 20 15" aria-labelledby="user-check" fill="#000000" role="presentation" class="icon icon-user-check">
                    <title id="user-check" lang="en">user-check icon</title>
                    <path d="m12 8c0 2.2091389-1.7908611 4-4 4-2.20913887 0-4-1.7908611-4-4 0-2.20913887 1.79086113-4 4-4 2.2091389 0 4 1.79086113 4 4 0 1.47275925 0 1.47275925 0 0zm-2 0c0 1.10456944-.89543056 2-2 2s-2-.89543056-2-2 .89543056-2 2-2 2 .89543056 2 2c0 .73637962 0 .73637962 0 0zm10.2940006.29199219 1.4119988 1.41600036-5.711999 5.70199965-2.7060003-2.7039995 1.4139996-1.4140005 1.2920007 1.2919998zm-6.2940006 10.70800781c0-3.3137085-2.6862917-6-6-6-3.31370854 0-6 2.6862915-6 6h2c0-2.2091391 1.79086089-4 4-4 2.2091389 0 4 1.7908609 4 4z" fill-rule="evenodd" transform="translate(-2 -4)"></path>
                    </svg>
                    <span><?=$model->acc->Name?></span>
                </div>
            <div class="tour-card__meta-item" tabindex="0">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" aria-labelledby="cup" fill="#000000" role="presentation" class="icon icon-cup">
                    <title id="cup" lang="en">cup icon</title>
                    <path d="m12.0141592 7.78859575c-.6888343 3.47426945-2.68802282 5.21140425-5.99756552 5.21140425s-5.30873119-1.7371348-5.99756548-5.21140425c-.10673644-.54187261.24637329-1.0674308.78831919-1.17379377.06361851-.01248585.12830048-.01875536.19313265-.01872014h10.03222726c.5522847-.00030109 1.0002441.44716989 1.0005453.99945456.0000354.06483217-.0062341.12951414-.0190934.19305935zm-9.81713236-7.55341313c.15899429-.24430219.47886777-.30869129.7144574-.14381707.82757739.57916883 1.26629164 1.33965293 1.26629164 2.24434126 0 .55374645-.15665965.87647464-.53301166 1.28798145l-.14020913.14757245c-.29892017.30539947-.36632758.42095004-.36632758.68860872 0 .29473219-.23040676.53365984-.51462791.53365984s-.51462791-.23892765-.51462791-.53365984c0-.56301293.15851173-.89103687.53833147-1.30667461l.13488932-.1422334c.30099079-.30751482.36632758-.41901783.36632758-.67525461 0-.52795056-.254318-.96879514-.8128051-1.35964477-.23558963-.16487421-.29768242-.49657722-.13868812-.74087942zm3.08776746 0c.1589943-.24430219.47886777-.30869129.7144574-.14381707.82757739.57916883 1.26629164 1.33965293 1.26629164 2.24434126 0 .55374645-.15665965.87647464-.53301166 1.28798145l-.14020913.14757245c-.29892017.30539947-.36632758.42095004-.36632758.68860872 0 .29473219-.23040676.53365984-.51462791.53365984s-.51462791-.23892765-.51462791-.53365984c0-.56301293.15851173-.89103687.53833147-1.30667461l.13488932-.1422334c.30099079-.30751482.36632758-.41901783.36632758-.67525461 0-.52795056-.254318-.96879514-.8128051-1.35964477-.23558963-.16487421-.29768242-.49657722-.13868812-.74087942zm3.08776746 0c.1589943-.24430219.47886777-.30869129.7144574-.14381707.8275774.57916883 1.26629164 1.33965293 1.26629164 2.24434126 0 .55374645-.1566596.87647464-.53301165 1.28798145l-.14020913.14757245c-.29892017.30539947-.36632759.42095004-.36632759.68860872 0 .29473219-.23040676.53365984-.51462791.53365984-.28422114 0-.51462791-.23892765-.51462791-.53365984 0-.56301293.15851174-.89103687.53833148-1.30667461l.13488931-.1422334c.30099079-.30751482.36632758-.41901783.36632758-.67525461 0-.52795056-.254318-.96879514-.8128051-1.35964477-.23558963-.16487421-.29768241-.49657722-.13868812-.74087942z" fill-rule="evenodd" ></path>
                </svg>
                <span><?=$model->meal->Name?></span>
            </div>
            </div>