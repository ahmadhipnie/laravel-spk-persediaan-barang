@extends('layouts.app')
@section('title', 'dashboard admin')
@section('content')

<div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 xl:w-4/12">
            <div
                class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="mb-0">Platform Settings</h6>
                </div>
                <div class="flex-auto p-4">
                    <h6 class="font-bold leading-tight uppercase text-xs text-slate-500">
                        Account
                    </h6>
                    <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <li class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">
                            <div class="min-h-6 mb-0.5 block pl-0">
                                <input id="follow"
                                    class="mt-0.54 rounded-10 duration-250
                      ease-soft-in-out after:rounded-circle
                      after:shadow-soft-2xl after:duration-250
                      checked:after:translate-x-5.25 h-5 relative float-left
                      ml-auto w-10 cursor-pointer appearance-none border
                      border-solid border-gray-200 bg-slate-800/10 bg-none
                      bg-contain bg-left bg-no-repeat align-top transition-all
                      after:absolute after:top-px after:h-4 after:w-4
                      after:translate-x-px after:bg-white after:content-['']
                      checked:border-slate-800/95 checked:bg-slate-800/95
                      checked:bg-none checked:bg-right"
                                    type="checkbox" "
                      checked />
                      <label
                        for="follow"
                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500"
                        for="flexSwitchCheckDefault"
                        >Email me when someone follows me</label
                      >
                    </div>
                  </li>
                  <li
                    class="relative block px-0 py-2 bg-white border-0 text-inherit">
                    <div class="min-h-6 mb-0.5 block pl-0">
                      <input
                        id="answer"
                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                        type="checkbox" />
                      <label
                        for="answer"
                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500"
                        for="flexSwitchCheckDefault1"
                        >Email me when someone answers on my post</label
                      >
                    </div>
                  </li>
                  <li
                    class="relative block px-0 py-2 bg-white border-0 rounded-b-lg text-inherit">
                    <div class="min-h-6 mb-0.5 block pl-0">
                      <input
                        id="mention"
                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                        type="checkbox"
                        checked />
                      <label
                        for="mention"
                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500"
                        for="flexSwitchCheckDefault2"
                        >Email me when someone mentions me</label
                      >
                    </div>
                  </li>
                </ul>
                <h6
                  class="mt-6 font-bold leading-tight uppercase text-xs text-slate-500">
                  Application
                </h6>
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li
                    class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">
                    <div class="min-h-6 mb-0.5 block pl-0">
                      <input
                        id="launches projects"
                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                        type="checkbox" />
                      <label
                        for="launches projects"
                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500"
                        for="flexSwitchCheckDefault3"
                        >New launches and projects</label
                      >
                    </div>
                  </li>
                  <li
                    class="relative block px-0 py-2 bg-white border-0 text-inherit">
                    <div class="min-h-6 mb-0.5 block pl-0">
                      <input
                        id="product updates"
                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                        type="checkbox"
                        checked />
                      <label
                        for="product updates"
                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500"
                        for="flexSwitchCheckDefault4"
                        >Monthly product updates</label
                      >
                    </div>
                  </li>
                  <li
                    class="relative block px-0 py-2 pb-0 bg-white border-0 rounded-b-lg text-inherit">
                    <div class="min-h-6 mb-0.5 block pl-0">
                      <input
                        id="subscribe"
                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                        type="checkbox" />
                      <label
                        for="subscribe"
                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500"
                        for="flexSwitchCheckDefault5"
                        >Subscribe to newsletter</label
                      >
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
            <div
              class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <div class="flex flex-wrap -mx-3">
                  <div
                    class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                    <h6 class="mb-0">Profile Information</h6>
                  </div>
                  <div
                    class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                    <a
                      href="javascript:;"
                      data-target="tooltip_trigger"
                      data-placement="top">
                      <i
                        class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                    </a>
                    <div
                      data-target="tooltip"
                      class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm"
                      role="tooltip">
                      Edit Profile
                      <div
                        class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                        data-popper-arrow></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex-auto p-4">
                <p class="leading-normal text-sm">
                  Hi, I’m Alec Thompson, Decisions: If you can’t decide, the
                  answer is no. If two equally difficult paths, choose the one
                  more painful in the short term (pain avoidance is creating an
                  illusion of equality).
                </p>
                <hr
                  class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-white to-transparent" />
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li
                    class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit">
                    <strong class="text-slate-700">Full Name:</strong> &nbsp;
                    Alec M. Thompson
                  </li>
                  <li
                    class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                    <strong class="text-slate-700">Mobile:</strong> &nbsp; (44)
                    123 1234 123
                  </li>
                  <li
                    class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                    <strong class="text-slate-700">Email:</strong> &nbsp;
                    alecthompson@mail.com
                  </li>
                  <li
                    class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                    <strong class="text-slate-700">Location:</strong> &nbsp; USA
                  </li>
                  <li
                    class="relative block px-4 py-2 pb-0 pl-0 bg-white border-0 border-t-0 rounded-b-lg text-inherit">
                    <strong class="leading-normal text-sm text-slate-700"
                      >Social:</strong
                    >
                    &nbsp;
                    <a
                      class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center text-blue-800 align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none"
                      href="javascript:;">
                      <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a
                      class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-600"
                      href="javascript:;">
                      <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a
                      class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-900"
                      href="javascript:;">
                      <i class="fab fa-instagram fa-lg"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
            <div
              class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <h6 class="mb-0">Conversations</h6>
              </div>
              <div class="flex-auto p-4">
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li
                    class="relative flex items-center px-0 py-2 mb-2 bg-white border-0 rounded-t-lg text-inherit">
                    <div
                      class="inline-flex items-center justify-center w-12 h-12 mr-4 text-white transition-all duration-200 text-base ease-soft-in-out rounded-xl">
                      <img
                        src="{{ asset('theme/img/kal-visuals-square.jpg') }}"
                        alt="kal"
                        class="w-full shadow-soft-2xl rounded-xl" />
                    </div>
                    <div class="flex flex-col items-start justify-center">
                      <h6 class="mb-0 leading-normal text-sm">Sophie B.</h6>
                      <p class="mb-0 leading-tight text-xs">
                        Hi! I need more information..
                      </p>
                    </div>
                    <a
                      class="inline-block py-3 pl-0 pr-4 mb-0 ml-auto font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in hover:scale-102 hover:active:scale-102 active:opacity-85 text-fuchsia-500 hover:text-fuchsia-800 hover:shadow-none active:scale-100"
                      href="javascript:;"
                      >Reply</a
                    >
                  </li>
                  <li
                    class="relative flex items-center px-0 py-2 mb-2 bg-white border-0 border-t-0 text-inherit">
                    <div
                      class="inline-flex items-center justify-center w-12 h-12 mr-4 text-white transition-all duration-200 text-base ease-soft-in-out rounded-xl">
                      <img
                        src="{{ asset('theme/img/marie.jpg') }}"
                        alt="kal"
                        class="w-full shadow-soft-2xl rounded-xl" />
                    </div>
                    <div class="flex flex-col items-start justify-center">
                      <h6 class="mb-0 leading-normal text-sm">Anne Marie</h6>
                      <p class="mb-0 leading-tight text-xs">
                        Awesome work, can you..
                      </p>
                    </div>
                    <a
                      class="inline-block py-3 pl-0 pr-4 mb-0 ml-auto font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in hover:scale-102 hover:active:scale-102 active:opacity-85 text-fuchsia-500 hover:text-fuchsia-800 hover:shadow-none active:scale-100"
                      href="javascript:;"
                      >Reply</a
                    >
                  </li>
                  <li
                    class="relative flex items-center px-0 py-2 mb-2 bg-white border-0 border-t-0 text-inherit">
                    <div
                      class="inline-flex items-center justify-center w-12 h-12 mr-4 text-white transition-all duration-200 text-base ease-soft-in-out rounded-xl">
                      <img
                        src="{{ asset('theme/img/ivana-square.jpg') }}"
                        alt="kal"
                        class="w-full shadow-soft-2xl rounded-xl" />
                    </div>
                    <div class="flex flex-col items-start justify-center">
                      <h6 class="mb-0 leading-normal text-sm">Ivanna</h6>
                      <p class="mb-0 leading-tight text-xs">
                        About files I can..
                      </p>
                    </div>
                    <a
                      class="inline-block py-3 pl-0 pr-4 mb-0 ml-auto font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in hover:scale-102 hover:active:scale-102 active:opacity-85 text-fuchsia-500 hover:text-fuchsia-800 hover:shadow-none active:scale-100"
                      href="javascript:;"
                      >Reply</a
                    >
                  </li>
                  <li
                    class="relative flex items-center px-0 py-2 mb-2 bg-white border-0 border-t-0 text-inherit">
                    <div
                      class="inline-flex items-center justify-center w-12 h-12 mr-4 text-white transition-all duration-200 text-base ease-soft-in-out rounded-xl">
                      <img
                        src="../assets/img/team-4.jpg"
                        alt="kal"
                        class="w-full shadow-soft-2xl rounded-xl" />
                    </div>
                    <div class="flex flex-col items-start justify-center">
                      <h6 class="mb-0 leading-normal text-sm">Peterson</h6>
                      <p class="mb-0 leading-tight text-xs">
                        Have a great afternoon..
                      </p>
                    </div>
                    <a
                      class="inline-block py-3 pl-0 pr-4 mb-0 ml-auto font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in hover:scale-102 hover:active:scale-102 active:opacity-85 text-fuchsia-500 hover:text-fuchsia-800 hover:shadow-none active:scale-100"
                      href="javascript:;"
                      >Reply</a
                    >
                  </li>
                  <li
                    class="relative flex items-center px-0 py-2 bg-white border-0 border-t-0 rounded-b-lg text-inherit">
                    <div
                      class="inline-flex items-center justify-center w-12 h-12 mr-4 text-white transition-all duration-200 text-base ease-soft-in-out rounded-xl">
                      <img
                        src="../assets/img/team-3.jpg"
                        alt="kal"
                        class="w-full shadow-soft-2xl rounded-xl" />
                    </div>
                    <div class="flex flex-col items-start justify-center">
                      <h6 class="mb-0 leading-normal text-sm">Nick Daniel</h6>
                      <p class="mb-0 leading-tight text-xs">
                        Hi! I need more information..
                      </p>
                    </div>
                    <a
                      class="inline-block py-3 pl-0 pr-4 mb-0 ml-auto font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in hover:scale-102 hover:active:scale-102 active:opacity-85 text-fuchsia-500 hover:text-fuchsia-800 hover:shadow-none active:scale-100"
                      href="javascript:;"
                      >Reply</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="flex-none w-full max-w-full px-3 mt-6">
            <div
              class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6 class="mb-1">Projects</h6>
                <p class="leading-normal text-sm">Architects design houses</p>
              </div>
              <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                  <div
                    class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                    <div
                      class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                      <div class="relative">
                        <a class="block shadow-xl rounded-2xl">
                          <img
                            src="{{ asset('theme/img/home-decor-1.jpg') }}"
                            alt="img-blur-shadow"
                            class="max-w-full shadow-soft-2xl rounded-2xl" />
                        </a>
                      </div>
                      <div class="flex-auto px-1 pt-6">
                        <p
                          class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">
                          Project #2
                        </p>
                        <a href="javascript:;">
                          <h5>Modern</h5>
                        </a>
                        <p class="mb-6 leading-normal text-sm">
                          As Uber works through a huge amount of internal
                          management turmoil.
                        </p>
                        <div class="flex items-center justify-between">
                          <button
                            type="button"
                            class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">
                            View Project
                          </button>
                          <div class="mt-2">
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-1.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Elena Morison
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-2.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Ryan Milly
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-3.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Nick Daniel
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-4.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Peterson
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                    <div
                      class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                      <div class="relative">
                        <a class="block shadow-xl rounded-2xl">
                          <img
                            src="{{ asset('theme/img/home-decor-2.jpg') }}"
                            alt="img-blur-shadow"
                            class="max-w-full shadow-soft-2xl rounded-xl" />
                        </a>
                      </div>
                      <div class="flex-auto px-1 pt-6">
                        <p
                          class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">
                          Project #1
                        </p>
                        <a href="javascript:;">
                          <h5>Scandinavian</h5>
                        </a>
                        <p class="mb-6 leading-normal text-sm">
                          Music is something that every person has his or her
                          own specific opinion about.
                        </p>
                        <div class="flex items-center justify-between">
                          <button
                            type="button"
                            class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">
                            View Project
                          </button>
                          <div class="mt-2">
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-3.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Nick Daniel
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-4.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Peterson
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-1.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Elena Morison
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-2.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Ryan Milly
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                    <div
                      class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                      <div class="relative">
                        <a class="block shadow-xl rounded-2xl">
                          <img
                            src="{{ asset('theme/img/home-decor-3.jpg') }}"
                            alt="img-blur-shadow"
                            class="max-w-full shadow-soft-2xl rounded-2xl" />
                        </a>
                      </div>
                      <div class="flex-auto px-1 pt-6">
                        <p
                          class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">
                          Project #3
                        </p>
                        <a href="javascript:;">
                          <h5>Minimalist</h5>
                        </a>
                        <p class="mb-6 leading-normal text-sm">
                          Different people have different taste, and various
                          types of music.
                        </p>
                        <div class="flex items-center justify-between">
                          <button
                            type="button"
                            class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">
                            View Project
                          </button>
                          <div class="mt-2">
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-4.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Peterson
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-3.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Nick Daniel
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-2.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Ryan Milly
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                            <a
                              href="javascript:;"
                              class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30"
                              data-target="tooltip_trigger"
                              data-placement="bottom">
                              <img
                                class="w-full rounded-circle"
                                alt="Image placeholder"
                                src="../assets/img/team-1.jpg" />
                            </a>
                            <div
                              data-target="tooltip"
                              class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                              role="tooltip">
                              Elena Morison
                              <div
                                class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                data-popper-arrow></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                    <div
                      class="relative flex flex-col h-full min-w-0 break-words bg-transparent border border-solid shadow-none rounded-2xl border-slate-100 bg-clip-border">
                      <div
                        class="flex flex-col justify-center flex-auto p-6 text-center">
                        <a href="javascript:;">
                          <i class="mb-4 fa fa-plus text-slate-400"></i>
                          <h5 class="text-slate-400">New project</h5>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="pt-4">
          <div class="w-full px-6 mx-auto">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
              <div
                class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                <div
                  class="leading-normal text-center text-sm text-slate-500 lg:text-left">
                  ©
                  <script>
                      document.write(new Date().getFullYear() + ",");
                  </script>
                  made with <i class="fa fa-heart"></i> by
                  <a
                    href="https://www.creative-tim.com"
                    class="font-semibold text-slate-700"
                    target="_blank"
                    >Creative Tim</a
                  >
                  for a better web.
                  <span class="w-full"> Distributed by ❤️ ThemeWagon </span>
                </div>
              </div>
              <div
                class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                <ul
                  class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                  <li class="nav-item">
                    <a
                      href="#!"
                      class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                      >Creative Tim</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      href="#!"
                      class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                      >About Us</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      href="#!"
                      class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                      >Blog</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      href="#!"
                      class="block px-4 pt-0 pb-1 pr-0 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                      >License</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <div fixed-plugin>
      <a
        fixed-plugin-button
        class="bottom-7.5 right-7.5 text-xl z-990 shadow-soft-lg rounded-circle fixed cursor-pointer bg-white px-4 py-2 text-slate-700">
        <i class="py-2 pointer-events-none fa fa-cog"> </i>
      </a>
      <!-- -right-90 in loc de 0-->
      <div
        fixed-plugin-card
        class="z-sticky shadow-soft-3xl w-90 ease-soft -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white bg-clip-border px-2.5 duration-200">
        <div class="px-6 pt-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
          <div class="float-left">
            <h5 class="mt-4 mb-0">Soft UI Configurator</h5>
            <p>See our dashboard options.</p>
          </div>
          <div class="float-right mt-6">
            <button
              fixed-plugin-close-button
              class="inline-block p-0 mb-4 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 active:opacity-85 text-slate-700">
              <i class="fa fa-close"></i>
            </button>
          </div>
          <!-- End Toggle Button -->
        </div>
        <hr
          class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
        <div class="flex-auto p-6 pt-0 sm:pt-4">
          <!-- Sidebar Backgrounds -->
          <div>
            <h6 class="mb-0">Sidebar Colors</h6>
          </div>
          <a href="javascript:void(0)">
            <div class="my-2 text-left" sidenav-colors>
              <span
                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-purple-700 to-pink-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                active-color
                data-color-from="purple-700"
                data-color-to="pink-500"
                onclick="sidebarColor(this)"></span>
              <span
                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-gray-900 to-slate-800 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color-from="gray-900"
                data-color-to="slate-800"
                onclick="sidebarColor(this)"></span>
              <span
                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-blue-600 to-cyan-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color-from="blue-600"
                data-color-to="cyan-400"
                onclick="sidebarColor(this)"></span>
              <span
                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-green-600 to-lime-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color-from="green-600"
                data-color-to="lime-400"
                onclick="sidebarColor(this)"></span>
              <span
                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-500 to-yellow-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color-from="red-500"
                data-color-to="yellow-400"
                onclick="sidebarColor(this)"></span>
              <span
                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-600 to-rose-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color-from="red-600"
                data-color-to="rose-400"
                onclick="sidebarColor(this)"></span>
            </div>
          </a>
          <!-- Sidenav Type -->
          <div class="mt-4">
            <h6 class="mb-0">Sidenav Type</h6>
            <p class="leading-normal text-sm">
              Choose between 2 different sidenav types.
            </p>
          </div>
          <div class="flex">
            <button
              transparent-style-btn
              class="inline-block w-full px-4 py-3 mb-2 font-bold text-center text-white uppercase align-middle transition-all border border-transparent border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500 bg-fuchsia-500 hover:border-fuchsia-500"
              data-class="bg-transparent"
              active-style>
              Transparent
            </button>
            <button
              white-style-btn
              class="inline-block w-full px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
              data-class="bg-white">
              White
            </button>
          </div>
          <p class="block mt-2 leading-normal text-sm xl:hidden">
            You can change the sidenav type just on desktop view.
          </p>
          <!-- Navbar Fixed -->
          <div class="mt-4">
            <h6 class="mb-0">Navbar Fixed</h6>
          </div>
          <div class="min-h-6 mb-0.5 block pl-0">
            <input
              class="rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
              type="checkbox"
              navbarFixed />
          </div>
          <hr
            class="h-px bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent sm:my-6" />

          <a
            class="inline-block w-full px-6 py-3 mb-4 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none"
            href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/soft-ui-dashboard/"
            target="_blank"
            >View documentation</a
          >
          <div class="w-full text-center">
            <a
              class="github-button"
              href="https://github.com/creativetimofficial/soft-ui-dashboard-tailwind"
              data-icon="octicon-star"
              data-size="large"
              data-show-count="true"
              aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub"
              >Star</a
            >
            <h6 class="mt-4">Thank you for sharing!</h6>
            <a
              href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20Tailwind%20made%20by%20%40CreativeTim&hashtags=webdesign,dashboard,tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard-tailwind"
              class="inline-block px-6 py-3 mb-0 mr-2 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
              target="_blank">
              <i class="mr-1 fab fa-twitter" aria-hidden="true"></i> Tweet
            </a>
            <a
              href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard-tailwind"
              class="inline-block px-6 py-3 mb-0 mr-2 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
              target="_blank">
              <i class="mr-1 fab fa-facebook-square" aria-hidden="true"></i>
              Share
            </a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
