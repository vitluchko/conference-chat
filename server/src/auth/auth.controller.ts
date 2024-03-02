import { Body, Controller, HttpCode, Post, Req, UseGuards } from "@nestjs/common";
import { AuthService } from "./auth.service";
import RegisterUserDto from "./dto/registerUser.dto";
import { LocalAuthenticationGuard } from "./guard/localAuthentication.guard";
import RequestWithUser from "./interface/requestWithUser.interface";

@Controller('auth')
export class AuthController {
    constructor(
        private readonly authenticationService: AuthService
    ) { }

    @Post('register')
    async register(@Body() registrationData: RegisterUserDto) {
        return this.authenticationService.register(registrationData);
    }

    @HttpCode(200)
    @UseGuards(LocalAuthenticationGuard)
    @Post('log-in')
    async logIn(@Req() request: RequestWithUser) {
        const user = request.user;
        user.password = undefined;
        return user;
    }
}
