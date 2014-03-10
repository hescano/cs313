public class User
{
	private String mUsername;
	private String mPassword;
	
	public User(String pUsername, String pPassword)
   {
	   mUsername = pUsername;
	   mPassword = pPassword;
   }

	public String getUsername()
	{
		return mUsername;
	}

	public void setUsername(String pUsername)
	{
		mUsername = pUsername;
	}
	
	public String getPassword()
	{
		return mPassword;
	}
	
	public void setPassword(String pPassword)
	{
		mPassword = pPassword;
	}
}
