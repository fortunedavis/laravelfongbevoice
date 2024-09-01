<div class="admin_aside">
                        <a href="{{route("admin.home")}}" class="">
                            Home
                            <i class="fi fi-rr-home"></i>
                        </a>
                        <a href="{{route("admin.recordandmessage")}}" class="">
                            Enregistrements
                            <i class="fi fi-rr-home"></i>
                        </a>
                        <a href="{{route("admin.sentences")}}">
                            Phrases
                            <i class="fi fi-rr-home"></i>
                        </a>
                        <a href="{{route("admin.users")}}" class="">
                            Users
                            <i class="fi fi-rr-home"></i>
                        </a>
                        @role("superadmin")
                        <a href="{{route("downloadfiles")}}" class="">
                            Telecharger Audios
                            <i class="fi fi-rr-download"></i>
                        </a>
                        @endrole
                        <a href="{{ route('export') }}">
                            Export CSV
                            <i class="fi fi-rr-download"></i>
                        </a>
                </div>