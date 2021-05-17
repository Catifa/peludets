function loginTesteo(data) {

    const axiosMock = jest.fn();

    axiosMock.mockReturnValueOnce({email: 'c@c.com', password: '33333'});

    let testAxios = axiosMock();

    return (data.email == testAxios.email && data.password == testAxios.password)
}
module.exports = loginTesteo;