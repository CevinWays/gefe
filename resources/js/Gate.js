export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }
    isMahasiswa(){
        return this.user.type === 'mahasiswa';
    }
    isDosen(){
        return this.user.type === 'dosen';
    }
    isStaff(){
        return this.user.type === 'staff';
    }
    isGuest(){
        return this.user.type === 'guest';
    }

}