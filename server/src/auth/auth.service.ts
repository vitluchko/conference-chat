import { HttpException, HttpStatus, Injectable } from "@nestjs/common";
import { UserService } from "src/user/user.service";
import * as bcrypt from 'bcrypt';
import RegisterUserDto from "./dto/registerUser.dto";

@Injectable()
export class AuthService {
    constructor(
        private readonly userService: UserService
    ) { }

    public async register(registrationData: RegisterUserDto) {
        const hashedPassword = await bcrypt.hash(registrationData.password, 10);
        try {
            const createdUser = await this.userService.create({
                ...registrationData,
                password: hashedPassword
            });
            createdUser.password = undefined;
            return createdUser;
        } catch (error) {
            if (error?.code === PostgresErrorCode.UniqueViolation) {
                throw new HttpException('User with that email already exists', HttpStatus.BAD_REQUEST);
            }
            throw new HttpException('Something went wrong', HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    public async getAuthenticatedUser(email: string, plainTextPassword: string) {
        try {
            const user = await this.userService.getByEmail(email);
            await this.verifyPassword(plainTextPassword, user.password);
            user.password = undefined;
            return user;
        } catch (error) {
            throw new HttpException('Wrong credentials provided', HttpStatus.BAD_REQUEST);
        }
    }

    private async verifyPassword(plainTextPassword: string, hashedPassword: string) {
        const isPasswordMatching = await bcrypt.compare(
            plainTextPassword,
            hashedPassword
        );
        if (!isPasswordMatching) {
            throw new HttpException('Wrong credentials provided', HttpStatus.BAD_REQUEST);
        }
    }
}
